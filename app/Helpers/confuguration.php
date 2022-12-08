<?php

use App\Http\Controllers\SendInvoiceToOBR;

define('RAISON_ENTREPRISE','PROTHEM-USINE');
define('BASE_FIRST_LETTER','P');
define('RAISON_ENTREPRISE_HEADER','PROTHEM-USINE');
define('BASE_NIF','4000004806');
define('BASE_RC','64503');
define('BASE_TELELEPHONE','+257 22 22 07 80 / +257 22 24 46 10');
define('BASE_BP','176');
define('BASE_COMMUNE','MUKAZA');
define('BASE_QUARTIER','Rohero II');
define('BASE_SECTEUR','INDUSTRIEL');
define('BASE_CENTRE_FISCAL','DGC');
define('BASE_AVENUE','BLV DE L\'UPRONA, N° 97');
define('BASE_TVA',18);
define('BASE_UNITE_EMBALLAGE',50);

// FOR TEST
define('OBR_USERNAME', env('OBR_USERNAME', 'ws400000480600270'));
define('OBR_PASSWORD', env('OBR_PASSWORD', '_B_/BGv0'));
//=== FOR PRODUCTION ===
// define('OBR_USERNAME', env('OBR_USERNAME', 'wsl400000480600187'));
// define('OBR_PASSWORD', env('OBR_PASSWORD', 'T?v?w7}I'));


?>