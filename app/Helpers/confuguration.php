<?php

// Variable pour la syncronisation des donnees dans OBR
define('CAN_SYNCRONISE', false);
define('TIME_OUT_SYNCRONISATION', (3 * 1000)); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_STOCK', true); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_INVOICE', true); // Seconde de Syncronisation dans OBR
define('MAIL_FROM_USER','client@advanced.bi');
define('CAN_BUCKUP_FILE',true); // Syncronisation des donnees en lignes

define('BASE_UNITE_EMBALLAGE', 50);
define('DAY_FOR_STOCK_DATA_SYNCRONIZE', 10);
define('RAISON_ENTREPRISE_HEADER', 'ADVANCED FACTURATION');
define('ARRONDIR_RESULTAT', true);
define('USE_ABONEMENT', true);
define('USE_LOCATION', false);
define('USE_LOGO', true);
define('USE_LOGO_NAME', true);
define('LOGO_NAME', "galerie_ideal.jpg");
define('INVOICE_PREFIX', '');
