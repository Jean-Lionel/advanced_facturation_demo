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
            'tp_name' => 'B@IT Health',
            'tp_type' => '2',
            'tp_TIN' => '4000604456',
            'tp_trade_number' => '05555',
            'tp_postal_number' => '176',
            'tp_phone_number' => '+25761576071',
            'tp_address_privonce' => 'BUJUMBURA-MAIRIE',
            'tp_address_commune' => 'MUHA',
            'tp_address_quartier' => 'Kinanira 3',
            'tp_address_avenue' => 'Saga',
            'tp_address_rue' => 'AVENUE SIGUVYAYE',
            'tp_address_number' => '99',
            'vat_taxpayer' => '1',
            'ct_taxpayer' => '0',
            'is_actif' => '1',
            'tl_taxpayer' => '0',
            'tp_fiscal_center' => 'DMC',
            'tp_activity_sector' => 'PRESTATION DE SERVICES INFORMATIQUES',
            'tp_legal_form' => 'SA',
            'payment_type' => '2',
            'user_id' => '1',

        ];
    }
}
