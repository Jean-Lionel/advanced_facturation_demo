<?php

// Variable pour la syncronisation des donnees dans OBR
define('CAN_SYNCRONISE', false);
define('TIME_OUT_SYNCRONISATION', (1 * 1000)); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_STOCK', false); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_INVOICE', false); // Seconde de Syncronisation dans OBR
define('MAIL_FROM_USER','client@advanced.bi');
define('CAN_BUCKUP_FILE',false); // Syncronisation des donnees en lignes

define('BASE_UNITE_EMBALLAGE', 50);
define('DAY_FOR_STOCK_DATA_SYNCRONIZE', 10);
define('RAISON_ENTREPRISE_HEADER', 'ADVANCED FACTURATION');
// // FOR TEST GEOCON

// TEST
// define('OBR_USERNAME', env('OBR_USERNAME'));
// define('OBR_PASSWORD', env('OBR_PASSWORD'));

