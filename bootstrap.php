<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$debug= filter_var( $_ENV['DEBUG'], FILTER_VALIDATE_BOOLEAN);
$app_mode=$_ENV['APP_MODE'];
$paypalConfig = [
    'client_id' =>$app_mode=='live'? $_ENV['PAYPAL_LIVE_CLIENT_ID']: $_ENV['PAYPAL_CLIENT_ID'],
    'client_secret' =>$app_mode=='live'? $_ENV['PAYPAL_LIVE_CLIENT_SECRET']: $_ENV['PAYPAL_CLIENT_SECRET'],
    'return_url' => getUrl().$_ENV['PAYPAL_RETURN_URL'],
    'cancel_url' => getUrl().$_ENV['PAYPAL_CANCEL_URL'],
    'success_url' => getUrl().$_ENV['PAYPAL_SUCCESS_URL'],
    'webhook_id' =>$app_mode=='live'? $_ENV['PAYPAL_LIVE_WEBHOOK_ID'] : $_ENV['PAYPAL_WEBHOOK_ID']
];

function getUrl()
{
    if(!filter_var( $_ENV['DEBUG'], FILTER_VALIDATE_BOOLEAN)){
        $protocol = (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) ? 'https://' : 'http://';
        $server = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'] ? ':'.$_SERVER['SERVER_PORT'] : '';
        return $protocol.$server.$port;
    }
    return 'https://example.com';
}
$tempDir=__DIR__;
try {
    $tempDir=__DIR__.'/temp';
    if( !is_dir( $tempDir ) )
    mkdir( $tempDir, 0777, true );
} catch (\Exception $e) {
    //throw $th;
}