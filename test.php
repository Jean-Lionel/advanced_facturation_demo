<?php

$url = "https://graph.facebook.com/v22.0/641511689034742/messages";

$accessToken = "EAAORP4Hmtz0BOZCFfYawyA1eGxBRggpBEYR3f1NrVSLyRDZAbMUpcCNBGhZBvmdIEn1nl1Lhi9uAqeZAuw8AqZCVC8rR5o3MCaDSdkPCbGZCxLmCBFeB2DpZB9RpobwzCbiMI0xMXmhLCZA1pz6gjYvNduyj2sbW9dnA7vlWzmyc8upZCYxkHHmAjc5qVVZCH7ZChhHD0KxNyBA3WWAv3FsvQslIh6tQRnMwDdTzHuV8ZBIWL3oZD"; // Remplace par ton jeton d'accès

$data = [
    "messaging_product" => "whatsapp",
    "to" => "25779614036",
    "type" => "template",
    "template" => [
        "name" => "hello_world",
        "language" => [
            "code" => "en_US"
        ]
    ]
];

$headers = [
    "Authorization: Bearer $accessToken",
    "Content-Type: application/json"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

echo $response;

?>
