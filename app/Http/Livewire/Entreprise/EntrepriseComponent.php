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

    protected $rules = [
        "tp_name" => "required",
        "tp_type" => "required",
        "tp_TIN" => "required",
        "tp_trade_number" => "required",
        "tp_postal_number" => "required",
        "tp_phone_number" => "required",
        "tp_address_privonce" => "required",
        "tp_address_quartier" => "required",
        "tp_address_avenue" => "required",
        "tp_address_rue" => "required",
        "tp_address_number" => "required",
        "vat_taxpayer" => "required",
        "ct_taxpayer" => "required",
        "tl_taxpayer" => "required",
        "tp_fiscal_center" => "required",
        "tp_activity_sector" => "required",
        "tp_legal_form" => "required",
        "payment_type" => "required",
    ];

    public function saveEntreprise(){
        $this->validate();
    }
}
