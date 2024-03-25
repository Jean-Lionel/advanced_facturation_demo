<?php

// Variable pour la syncronisation des donnees dans OBR
define('CAN_SYNCRONISE', true);
define('IS_PRODUCTION', false);
define('TIME_OUT_SYNCRONISATION', (1 * 1000)); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_STOCK', true); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_INVOICE', true); // Seconde de Syncronisation dans OBR
define('MAIL_FROM_USER','client@advanced.bi');
define('CAN_BUCKUP_FILE',false); // Syncronisation des donnees en lignes

define('BASE_UNITE_EMBALLAGE', 50);
define('RAISON_ENTREPRISE_HEADER', 'ADVANCED FACTURATION');
// // FOR TEST GEOCON

// TEST GEOCON
// define('OBR_USERNAME', env('OBR_USERNAME', 'ws400204317400636'));
// define('OBR_PASSWORD', env('OBR_PASSWORD', '&C879fTw'));
// ===== PRODUCTION GEOCON =================
//define('OBR_USERNAME', env('OBR_USERNAME', 'wsl400204317400423'));
//define('OBR_PASSWORD', env('OBR_PASSWORD', '0?Fs-;;N'));

/* EFCCO
- nom d’utilisateur : ws400167159500661
- mot de passe : 2<@KYoo[

    define('OBR_USERNAME', env('OBR_USERNAME', 'ws400167159500661'));
    define('OBR_PASSWORD', env('OBR_PASSWORD', '2<@KYoo['));
    */

    /*
    KELIG MOTORS COMPANY
    - nom d’utilisateur : ws400086611300667
    - mot de passe : cTzm1M|o
    */
    // define('OBR_USERNAME', env('OBR_USERNAME', 'ws400086611300667'));
    // define('OBR_PASSWORD', env('OBR_PASSWORD', 'cTzm1M|o'));

    /**
    * PRODUCTION EFCCO
    * -nom d'utilisateur: wsl400167159500437
    * -mot de passe: qIg#$f-5
    */
    // define('OBR_USERNAME', env('OBR_USERNAME', 'wsl400167159500437'));
    // define('OBR_PASSWORD', env('OBR_PASSWORD', 'qIg#$f-5'));

    /**
    *
    * Veuillez trouver, en dessous, les identifiants de KELIG MOTORS COMPANY sur le serveur de production :
        * -nom d'utilisateur: wsl400086611300438
        * -mot de passe: 3Ku&l^RI
        */

// OBR_USERNAME=ws400000480600270
// OBR_PASSWORD=_B_/BGv0

// define('OBR_USERNAME', env('OBR_USERNAME', 'ws400000480600270'));
// define('OBR_PASSWORD', env('OBR_PASSWORD', '_B_/BGv0'));

// Production Prothem

/**
 * B@IT HEALTH
 *  - nom d’utilisateur : ws400060445600690
 *  - mot de passe : 0Qw-c!I|
 */

define('OBR_USERNAME', env('OBR_USERNAME', 'ws400060445600690'));
define('OBR_PASSWORD', env('OBR_PASSWORD', '0Qw-c!I|'));

