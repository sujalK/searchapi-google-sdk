<?php

require_once 'searchapigoogle_sdk.php';

$client = new SearchapiGoogleSDK();
$result = $client->direct([
    "path"   => "/search",
    "method" => "GET",
    "query"  => [
        "engine"  => "google",
        "q"       => "robot",
        "api_key" => "",
    ],
]);

print_r($result);