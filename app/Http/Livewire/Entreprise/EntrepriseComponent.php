<?php

namespace App\Http\Livewire\Entreprise;

use Livewire\Component;
use App\Models\Entreprise;

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
        $element = Entreprise::where('is_actif', '1')->first();

        return view('livewire.entreprise.entreprise-component', [
            'element' => $element
        ]);
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
        "tp_address_commune" => "required",
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
        $data = [
            "tp_name" => $this->tp_name,
            "tp_type" => $this->tp_type,
            "tp_TIN" => $this->tp_TIN,
            "tp_trade_number" => $this->tp_trade_number,
            "tp_postal_number" => $this->tp_postal_number,
            "tp_phone_number" => $this->tp_phone_number,
            "tp_address_privonce" => $this->tp_address_privonce,
            "tp_address_commune" => $this->tp_address_commune,
            "tp_address_quartier" => $this->tp_address_quartier,
            "tp_address_avenue" => $this->tp_address_avenue,
            "tp_address_rue" => $this->tp_address_rue,
            "tp_address_number" => $this->tp_address_number,
            "vat_taxpayer" => $this->vat_taxpayer,
            "ct_taxpayer" => $this->ct_taxpayer,
            "tl_taxpayer" => $this->tl_taxpayer,
            "tp_fiscal_center" => $this->tp_fiscal_center,
            "tp_activity_sector" => $this->tp_activity_sector,
            "tp_legal_form" => $this->tp_legal_form,
            "payment_type" => $this->payment_type,
            "user_id" => auth()->user()->id
        ];

        Entreprise::create($data);


    }
}
