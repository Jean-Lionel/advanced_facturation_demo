<?php

namespace App\Http\Livewire\Location;

use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use App\Models\PeriodePaimentLocation;
use Livewire\Component;

class PaymentMensuel extends Component
{
    public $houseNumber = '';
    public $maisonLocations;
    public $paymentSums = [];

    public function mount()
    {
        $this->canCreatePaymentPeriode();
        $this->loadMaisonLocations();
    }

    public function render()
    {
        $periodesPayment = PeriodePaimentLocation::latest()->take(3)->get();

        return view('livewire.location.payment-mensuel', [
            'periodes' => $periodesPayment,
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

    public function updatedHouseNumber()
    {
        $this->loadMaisonLocations();
    }

    private function loadMaisonLocations(): void
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

        $this->maisonLocations = $query->latest()->take(50)->get();
        $this->loadPaymentSums();

        $periodes = PeriodePaimentLocation::latest()->take(3)->get();
        $this->maisonLocations = sortMaisonsByUnpaidStatus($this->maisonLocations, $periodes, $this->paymentSums);
    }

    private function loadPaymentSums(): void
    {
        $periodeIds = PeriodePaimentLocation::latest()->take(3)->pluck('id');
        $maisonIds = collect($this->maisonLocations)->pluck('id');

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
}