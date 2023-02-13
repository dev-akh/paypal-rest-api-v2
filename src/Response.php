<?php

use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Payments\CapturesGetRequest;
use PayPalCheckoutSdk\Client\Client;

include __DIR__.'/../bootstrap.php';

if (empty($_GET['token']) || empty($_GET['PayerID'])) {
    throw new Exception('The response is missing the Order ID');
}

$token = $_GET['token'];
$payerId = $_GET['PayerID'];


$dir=$tempDir.'/OrdersCaptured/';
if( !is_dir( $dir ) )
    mkdir( $dir, 0777, true );
    
try {
    $request = new OrdersCaptureRequest($token);
    $client = Client::make($paypalConfig['client_id'],$paypalConfig['client_secret'],$app_mode);
    $response = $client->execute($request);
    $invoice_id=$response->result->purchase_units[0]->payments->captures[0]->invoice_id;
    $data=json_encode($response);

    file_put_contents($dir.'order-captured-response-'.$invoice_id.'.json',$data);
} catch (Exception $e) {
    file_put_contents($dir.'order-capture-error-'.$invoice_id.'.txt',$e);
    exit(1);
}

header('location:'.$paypalConfig['success_url']);
exit(1);