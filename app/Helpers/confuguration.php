<?php

use App\Http\Controllers\SendInvoiceToOBR;

define('RAISON_ENTREPRISE', 'PROTHEM-USINE');
define('BASE_FIRST_LETTER', 'P');
define('RAISON_ENTREPRISE_HEADER', 'PROTHEM-USINE');
define('BASE_NIF', '4000004806');
define('BASE_RC', '64503');
define('BASE_TELELEPHONE', '+257 22 22 07 80 / +257 22 24 46 10');
define('BASE_BP', '176');
define('BASE_COMMUNE', 'MUKAZA');
//define('BASE_QUARTIER', 'Rohero II');
define('BASE_QUARTIER', 'KIRIRI');
define('BASE_SECTEUR', 'INDUSTRIEL');
define('BASE_CENTRE_FISCAL', 'DGC');
define('BASE_AVENUE', 'Avenue Martin Luther King N°29');
define('BASE_TVA', 18);
define('BASE_UNITE_EMBALLAGE', 50);

// // FOR TEST PROTHEM
// define('OBR_USERNAME', env('OBR_USERNAME', 'ws400000480600270'));
// define('OBR_PASSWORD', env('OBR_PASSWORD', '_B_/BGv0'));

// Production Prothem

define('OBR_USERNAME', env('OBR_USERNAME', 'wsl400000480600187'));
define('OBR_PASSWORD', env('OBR_PASSWORD', 'T?v?w7}I'));

// FOR TEST BST SOLUTION
// define('OBR_USERNAME', env('OBR_USERNAME', 'ws400199682800460'));
// define('OBR_PASSWORD', env('OBR_PASSWORD', 'Zt@eVzY9'));
// FOR TEST DUKORE TECH
// define('OBR_USERNAME', env('OBR_USERNAME', 'ws400199682800460'));
// define('OBR_PASSWORD', env('OBR_PASSWORD', 'Zt@eVzY9'));
//=== FOR PRODUCTION ===
//  define('OBR_USERNAME', env('OBR_USERNAME', 'wsl400000480600187'));
//  define('OBR_PASSWORD', env('OBR_PASSWORD', 'T?v?w7}I'));


?>
