<?php

namespace App\Http\Livewire\Location;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\MaisonLocation;
use App\Models\Order;
use App\Models\PaymentLocationMensuel;
use App\Models\PeriodePaimentLocation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentMensuelForm extends Component
{
    public $maison;
    public $periode;
    public $returnTo;

    public $payementDate;
    public $montant;
    public $description;
    public $typePaiement;

    public $totalPaid = 0;
    public $remainingAmount = 0;
    public $isAlreadyPaid = false;

    protected $rules = [
        'payementDate' => 'required|date',
        'montant' => 'required|numeric|min:1',
        'typePaiement' => 'required',
    ];

    public function mount($maisonLocation, $periode, $returnTo = 'payment-location-mensuel')
    {
        $this->maison = MaisonLocation::with('clients')->findOrFail($maisonLocation);
        $this->periode = PeriodePaimentLocation::findOrFail($periode);
        $this->returnTo = in_array($returnTo, ['maison-location', 'payment-location-mensuel'])
            ? $returnTo
            : 'payment-location-mensuel';

        $this->payementDate = date('Y-m-d');
        $this->montant = $this->maison->montant;

        $this->totalPaid = PaymentLocationMensuel::where('periode_paiement_id', $this->periode->id)
            ->where('maisonlocation_id', $this->maison->id)
            ->sum('montant');

        $this->remainingAmount = max(0, $this->maison->montant - $this->totalPaid);
        $this->isAlreadyPaid = $this->totalPaid >= $this->maison->montant;

        if (!$this->isAlreadyPaid && $this->remainingAmount < $this->montant) {
            $this->montant = $this->remainingAmount;
        }
    }

    public function render()
    {
        return view('livewire.location.payment-mensuel-form');
    }

    public function savePayment()
    {
        if ($this->isAlreadyPaid) {
            session()->flash('error', 'Cette période est déjà entièrement payée.');
            return;
        }

        $this->validate();

        try {
            DB::beginTransaction();

            $totalAmount = PaymentLocationMensuel::where('periode_paiement_id', $this->periode->id)
                ->where('maisonlocation_id', $this->maison->id)
                ->sum('montant');

            if ($totalAmount >= $this->maison->montant) {
                throw new \Exception('La période de paiement est déjà payée.');
            }

            if ($totalAmount + $this->montant > $this->maison->montant) {
                throw new \Exception('Montant restant : ' . ($this->maison->montant - $totalAmount));
            }

            $paiementM = PaymentLocationMensuel::create([
                'maisonlocation_id' => $this->maison->id,
                'description' => $this->description,
                'montant' => $this->montant,
                'date_paiement' => $this->payementDate,
                'user_id' => auth()->user()->id,
                'periode_paiement_id' => $this->periode->id,
                'total_payment_mensuel' => $this->maison->montant,
            ]);

            $client = new Client([
                'id' => $this->maison->ClientId,
                'name' => substr($this->maison->clientName ?? '', 0, 100),
                'addresse' => substr($this->maison->adresse ?? '', 0, 100),
                'customer_TIN' => $this->maison->customer_TIN,
                'vat_customer_payer' => $this->maison->vatCustomerPayer,
            ]);

            $prixVenteTvac = prixVenteTvac($this->montant, ($this->maison->tax / 100));
            $order = Order::create([
                'amount' => $prixVenteTvac,
                'total_quantity' => 1,
                'total_sacs' => 0,
                'tax' => ($prixVenteTvac - $this->montant),
                'type_paiement' => $this->typePaiement,
                'amount_tax' => $this->montant,
                'products' => serialize($this->getProduct()),
                'client' => $client->toJson(),
                'addresse_client' => substr($this->maison->adresse ?? '', 0, 100),
                'date_facturation' => now(),
                'is_cancelled' => 0,
                'client_id' => $this->maison->ClientId,
                'commissionaire_id' => null,
                'maison_id' => $paiementM->id,
                'company' => Entreprise::currentEntreprise()->toJson(),
            ]);

            $signature = SendInvoiceToOBR::getInvoinceSignature($order->id, $order->created_at);
            $order->invoice_signature = $signature;
            $order->save();

            $paiementM->order_id = $order->id;
            $paiementM->save();

            DB::commit();

            return redirect()->to('orders/' . $order->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
        }
    }

    public function getBackUrl(): string
    {
        return $this->returnTo === 'maison-location'
            ? route('maison-location.index')
            : route('payment-location-mensuel.index');
    }

    protected function getProduct(): array
    {
        $paidTime = $this->periode->month . '/' . $this->periode->year;

        return [[
            'id' => $this->maison->id,
            'name' => 'Loyer [ ' . $paidTime . ' ] || ' . $this->maison->name . ' || ' . $this->description . '  ',
            'rowId' => '',
            'price' => $this->maison->montant,
            'price_revient' => $this->maison->montant,
            'quantite' => 1,
            'nombre_sac' => 0,
            'embalage' => 0,
            'item_ct' => 0,
            'item_tl' => 0,
            'item_price_nvat' => $this->maison->montant,
            'interet_unitaire' => 0,
            'interet_total' => 0,
            'vat' => $this->maison->tva,
            'item_price_wvat' => $this->maison->priceTTC,
            'item_total_amount' => $this->maison->priceTTC,
        ]];
    }
}