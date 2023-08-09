<?php

function getPrice($price)
{

    $price = floatval($price);
    return number_format($price, 2, ',', ' . ');
}

function getMouvement($key){
    $t = [
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

    return  $t[$key];
}

//sendHttpRequest("https://ebms.obr.gov.bi:9443/ebms_api/AddStockMovement/");

function sendHttpRequest($url, $method = "POST", $headers = [], $data = [])
{
    // Create a new cURL resource
    $ch = curl_init();

    // Set the URL to which the request will be sent
    curl_setopt($ch, CURLOPT_URL, $url);

    // Set the request method
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    // Set any additional request headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Set the request payload if needed
    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    // Set options for handling the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and fetch the response
    $response = curl_exec($ch);

    // Check for any errors
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        // Handle the error as needed
        curl_close($ch);
        return false;
    }

    // Close the cURL resource
    curl_close($ch);

    return $response;
}

// // Example usage:
// $url = "https://ebms.obr.gov.bi:8443/ebms_api/";
// $headers = array(
//     'Content-Type: application/json',
//     //'Authorization: Bearer your_token_here'
// );
// $data = array(
//     'param1' => 'value1',
//     'param2' => 'value2'
// );

// $response = sendHttpRequest($url, "POST", $headers, $data);

// if ($response !== false) {
//     // Process the response
//     echo $response;
// } else {
//     // Handle the error
//     echo "Error occurred during the request.";
// }
