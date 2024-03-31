<?php

function isInternetConnection(){
    try{
        if(fsockopen('www.google.fr',80)){
            return true;
        }
    }catch(\Exception $e){
        return false;
    }
}

function getPrice($price)
{
    $price = floatval($price);
    return number_format($price, 2, ',', ' . ');
}
const MOUVEMENT_STOCK = [
    'EN' => 'Entrée Normales',
    'ER' => 'Entrée Retour',
    'EI' => 'Entrée Inventaire',
    'EAJ' => 'Entrées Ajustement',
    'ET' => 'Entrées Transfert',
    'EAU' => 'Entrées Autres',
    'SN' => 'Sorties Normales',
    'SP' => 'Sorties Perte',
    'SV' => 'Sorties Vol',
    'SD' => 'Sorties Désuétude',
    'SC' => 'Sorties Casse',
    'SAJ' => 'Sorties Ajustement',
    'ST' => 'Sorties Transfert',
    'SAU' => 'Sorties Autres',
];

function getMouvement($key){
    return  MOUVEMENT_STOCK[$key];
}

function setActiveRoute($route){
    return request()->routeIs($route) ? 'active' : '';
}
