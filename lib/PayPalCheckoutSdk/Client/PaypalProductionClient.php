<?php
namespace PayPalCheckoutSdk\Client;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

class PaypalProductionClient{
    public static function client($clientId,$clientSecret)
    {
        return new PayPalHttpClient(self::environment($clientId,$clientSecret));
    }
    public static function environment($clientId,$clientSecret)
    {
        return new ProductionEnvironment($clientId, $clientSecret);
    }
}