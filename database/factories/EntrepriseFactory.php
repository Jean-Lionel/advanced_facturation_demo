<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => '1',
            'tp_name' => 'ADVANCED IT AND RESEARCH BURUNDI',
            'tp_type' => '2',
            'tp_TIN' => '40000000',
            'tp_trade_number' => '06418',
            'tp_postal_number' => '000',
            'tp_phone_number' => '+257 79614036',
            'tp_address_privonce' => 'BUJUMBURA-MAIRIE',
            'tp_address_commune' => 'MUKAZA',
            'tp_address_quartier' => 'ROHERO',
            'tp_address_avenue' => 'AVENUE MWARO NO 13',
            'tp_address_rue' => '14',
            'tp_address_number' => '0',
            'vat_taxpayer' => '1',
            'ct_taxpayer' => '0',
            'is_actif' => '1',
            'tl_taxpayer' => '0',
            'tp_fiscal_center' => 'DMC',
            'tp_activity_sector' => 'Entreprise des Logiciels ',
            'tp_legal_form' => 'SURL',
            'payment_type' => '2',
            'user_id' => '1',

        ];
    }
}
