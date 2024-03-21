<?php

// Variable pour la syncronisation des donnees dans OBR
define('CAN_SYNCRONISE', true);
define('IS_PRODUCTION', true);
define('TIME_OUT_SYNCRONISATION', (1 * 1000)); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_STOCK', true); // Seconde de Syncronisation dans OBR
define('CAN_SYNCRONISE_INVOICE', true); // Seconde de Syncronisation dans OBR
define('MAIL_FROM_USER','client@advanced.bi');
define('CAN_BUCKUP_FILE',true); // Syncronisation des donnees en lignes

//===================ALLORS ON DANSE==========================
define('RAISON_ENTREPRISE', 'KELIG');
define('BASE_FIRST_LETTER', 'K');
// define('RAISON_ENTREPRISE_HEADER', 'ADVANCED IT AND RESEARCH BURUNDI');
// define('RAISON_ENTREPRISE_HEADER', 'ENTREPRISE DE FABRICATION DE LA CHAUX ET DE CONSTRUCTION');
define('RAISON_ENTREPRISE_HEADER', 'KELIG MOTORS COMPANY');
define('BASE_NIF', '400xxxxxxx');
define('BASE_RC', '38222/22');
define('BASE_TELELEPHONE', '+257 79 614 036');
define('SECTEUR_ACTIVITE', 'TECHNOLOGY');
define('EMAIL_ENTREPRISE', 'nijeanlionel@gmail.com');
define('WEBSITE_ENTREPRISE', '');
define('BOITE_POSTAL', 'B.P. 329 Bujumbura, BURUNDI,');
define('COMPANY_DESCRIPTION', '');
define('BASE_BP', '329');
define('BASE_COMMUNE', 'NTAHANGWA');
//define('BASE_QUARTIER', 'Rohero II');
define('BASE_QUARTIER', 'KIGOBE');
define('BASE_SECTEUR', 'TECHNOLOGY');
define('BASE_CENTRE_FISCAL', 'DMC');
define('BASE_FORME_JURDIQUE', 'SPRL');
define('BASE_AVENUE', 'AVENUE DES ETATS UNIS  No 76');
define('BASE_TVA', 10);
define('BASE_UNITE_EMBALLAGE', 50);
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

define('OBR_USERNAME', env('OBR_USERNAME', 'ws400000480600270'));
define('OBR_PASSWORD', env('OBR_PASSWORD', '_B_/BGv0'));

