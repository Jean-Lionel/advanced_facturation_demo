<?php

// Variable pour la syncronisation des donnees dans OBR
define('CAN_SYNCRONISE', env('OBR_CAN_SYNCRONISE', true)  );
define('TIME_OUT_SYNCRONISATION', (3 * 1000)); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_STOCK', true); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_INVOICE', true); // Seconde de Syncronisation dans OBR
define('MAIL_FROM_USER','client@advanced.bi');
define('CAN_BUCKUP_FILE',true); // Syncronisation des donnees en lignes

define('BASE_UNITE_EMBALLAGE', 50);
define('DAY_FOR_STOCK_DATA_SYNCRONIZE', 10);
define('RAISON_ENTREPRISE_HEADER', 'ADVANCED FACTURATION');
define('ARRONDIR_RESULTAT', true);
define('USE_ABONEMENT', env('APP_USE_ABONEMENT', false) );
define('USE_LOCATION', env('APP_USE_LOCATION', false) );
define('USE_LOGO', env('APP_USE_LOGO', false) );
define('USE_LOGO_NAME', env('APP_USE_LOGO', false));
define('LOGO_NAME', env('USE_LOGO_NAME', "logo.jpg") ); // "galerie_ideal.jpg
define('INVOICE_PREFIX', '');
define( 'TYPE_MONNAIE', ['BIF', 'USD', 'EUR']);
// define partage for
define(  'PARTAGE_INFORMATICIEN', 15);
define(  'PARTAGE_CLIENT', 2.5);
define(  'PARTAGE_COMMISSIONNAIRE', 2.5);
define(  'PARTAGE_ENTREPRISE',  80);
define(  'TEMPS_GENERATION_FACTURE',  60 );
