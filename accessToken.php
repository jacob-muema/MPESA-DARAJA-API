<?php

// Daraja API credentials
$consumerKey = "c2eU3Whc0UhkTrJsjNurmVG4qy8jTq1505d1lgcGeAYm9QTG";
$consumerSecret = "VL6IIKuxF92hg0axZYgXLVMFSiiqMGAJhsQzaYPXwfTMvdQxO06AlnpghPyGEWGw";

// Base64 encode the consumer key and consumer secret
$credentials = base64_encode($consumerKey . ":" . $consumerSecret);

// Daraja API authentication endpoint
$access_token_url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

// Set the header
$header = ['Content-Type: application/json'];

// Initialize cURL session
$curl = curl_init($access_token_url);

// Set cURL options
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_USERPWD, "$consumerKey:$consumerSecret"); // Fixed authentication header

// Execute cURL request to get access token
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

// Check for errors in access token generation
if ($status != 200) {
    echo "Error: Failed to generate access token. HTTP Status Code: $status";
} else {
    // Decode the response JSON
    $result = json_decode($result);
    // Extract access token
    $access_token = $result->access_token;
    // Output access token
    echo "Access Token: $access_token";
}

// Close cURL session
curl_close($curl);

?>
