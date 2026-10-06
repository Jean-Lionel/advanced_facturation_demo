<?php

namespace App\Http\Livewire\Location;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\CanceledInvoince;
use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use App\Models\PeriodePaimentLocation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentMensuel extends Component
{
    public $houseNumber = '';
    public $paymentSums = [];

    // Annulation de paiement
    public $cancelMaisonId;
    public $cancelPeriodeId;
    public $cancelPaymentId;
    public $motifAnnulation = '';

    public function mount()
    {
        $this->canCreatePaymentPeriode();
    }

    public function render()
    {
        $periodesPayment = PeriodePaimentLocation::latest()->take(3)->get();

        return view('livewire.location.payment-mensuel', [
            'periodes' => $periodesPayment,
            'maisonLocations' => $this->loadMaisonLocations($periodesPayment),
            'cancelPayments' => $this->getCancelPayments(),
        ]);
    }

    private function canCreatePaymentPeriode()
    {
        $check = PeriodePaimentLocation::where('month', date('m'))
            ->where('year', date('Y'))
            ->first();

        if (is_null($check)) {
            PeriodePaimentLocation::create([
                'month' => date('m'),
                'year' => date('Y'),
                'user_id' => auth()->user()->id,
            ]);
        }
    }

    private function loadMaisonLocations($periodes)
    {
        $query = MaisonLocation::with('clients')
            ->withCount('clients')
            ->whereHas('clients');

        if (strlen($this->houseNumber)) {
            $search = $this->houseNumber;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $maisonLocations = $query->latest()->take(50)->get();
        $this->loadPaymentSums($maisonLocations->pluck('id'), $periodes->pluck('id'));

        return sortMaisonsByUnpaidStatus($maisonLocations, $periodes, $this->paymentSums);
    }

    private function loadPaymentSums($maisonIds, $periodeIds): void
    {
        if ($maisonIds->isEmpty() || $periodeIds->isEmpty()) {
            $this->paymentSums = [];
            return;
        }

        $this->paymentSums = PaymentLocationMensuel::query()
            ->whereIn('maisonlocation_id', $maisonIds)
            ->whereIn('periode_paiement_id', $periodeIds)
            ->selectRaw('maisonlocation_id, periode_paiement_id, SUM(montant) as total_paid')
            ->groupBy('maisonlocation_id', 'periode_paiement_id')
            ->get()
            ->keyBy(fn ($payment) => $payment->maisonlocation_id . '-' . $payment->periode_paiement_id)
            ->toArray();
    }

    public function isPeriodePaid(int $maisonId, int $periodeId, float $montant): bool
    {
        $key = $maisonId . '-' . $periodeId;
        $totalPaid = $this->paymentSums[$key]['total_paid'] ?? 0;

        return $totalPaid >= $montant;
    }

    public function hasPayments(int $maisonId, int $periodeId): bool
    {
        return ($this->paymentSums[$maisonId . '-' . $periodeId]['total_paid'] ?? 0) > 0;
    }

    public function showCancelPayments(int $maisonId, int $periodeId): void
    {
        $this->cancelMaisonId = $maisonId;
        $this->cancelPeriodeId = $periodeId;
        $this->cancelPaymentId = null;
        $this->motifAnnulation = '';
    }

    public function closeCancelPayments(): void
    {
        $this->reset(['cancelMaisonId', 'cancelPeriodeId', 'cancelPaymentId', 'motifAnnulation']);
    }

    public function selectPaymentToCancel(int $paymentId): void
    {
        $this->cancelPaymentId = $paymentId;
        $this->motifAnnulation = '';
    }

    public function cancelPayment(): void
    {
        $this->validate([
            'cancelPaymentId' => 'required|integer',
            'motifAnnulation' => 'required|string|min:3',
        ]);

        $payment = PaymentLocationMensuel::with('order')
            ->where('maisonlocation_id', $this->cancelMaisonId)
            ->where('periode_paiement_id', $this->cancelPeriodeId)
            ->find($this->cancelPaymentId);

        if (!$payment) {
            session()->flash('error', 'Paiement introuvable.');
            return;
        }

        $order = $payment->order;
        $cancelInvoice = null;

        try {
            DB::beginTransaction();

            if ($order && !$order->is_cancelled) {
                $cancelInvoice = CanceledInvoince::create([
                    'motif' => $this->motifAnnulation,
                    'invoice_signature' => $order->invoice_signature,
                    'created_at' => now(),
                    'status' => false,
                    'order_id' => $order->id,
                ]);

                $order->is_cancelled = true;
                $order->save();
            }

            $payment->description = trim(($payment->description ?? '') . ' [ANNULÉ : ' . $this->motifAnnulation . ']');
            $payment->save();
            $payment->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            return;
        }

        $message = 'Le paiement a été annulé.';

        // Envoi de l'annulation à l'OBR ; en cas d'échec, la synchronisation la reprendra
        if ($cancelInvoice) {
            if (isInternetConnection() && CAN_SYNCRONISE) {
                try {
                    $response = (new SendInvoiceToOBR())->cancelInvoice($order->invoice_signature, $this->motifAnnulation);
                    if ($response->success ?? false) {
                        $cancelInvoice->status = true;
                        $cancelInvoice->save();
                    } else {
                        $message .= ' Annulation OBR en attente : ' . ($response->msg ?? 'réponse invalide');
                    }
                } catch (\Throwable $th) {
                    $message .= ' Annulation OBR en attente : ' . $th->getMessage();
                }
            } else {
                $order->canceled_or_connection = 'ANNULEE HORS CONNECTION';
                $order->save();
                $message .= ' Annulation OBR en attente de synchronisation.';
            }
        }

        session()->flash('success', $message);

        $this->cancelPaymentId = null;
        $this->motifAnnulation = '';
    }

    private function getCancelPayments()
    {
        if (!$this->cancelMaisonId || !$this->cancelPeriodeId) {
            return collect();
        }

        return PaymentLocationMensuel::with(['order', 'user', 'periode', 'maisonlocation'])
            ->where('maisonlocation_id', $this->cancelMaisonId)
            ->where('periode_paiement_id', $this->cancelPeriodeId)
            ->latest()
            ->get();
    }
}
