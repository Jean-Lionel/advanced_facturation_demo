<?php

namespace App\Http\Livewire\Entreprise;

use Livewire\Component;

class EntrepriseComponent extends Component
{

    public $tp_name = "";
    public $tp_type = "";
    public $tp_TIN = "";
    public $tp_trade_number = "";
    public $tp_postal_number = "";
    public $tp_phone_number = "";
    public $tp_address_privonce = "";
    public $tp_address_commune = "";
    public $tp_address_quartier = "";
    public $tp_address_avenue = "";
    public $tp_address_rue = "";
    public $tp_address_number = "";
    public $vat_taxpayer = "";
    public $ct_taxpayer = "";
    public $tl_taxpayer = "";
    public $tp_fiscal_center = "";
    public $tp_activity_sector = "";
    public $tp_legal_form = "";
    public $payment_type = "";

    public function render()
    {
        return view('livewire.entreprise.entreprise-component');
    }
}
