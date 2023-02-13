<?php
namespace PayPalCheckoutSdk\Client;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PaypalClient{
    public static function client($clientId,$clientSecret)
    {
        return new PayPalHttpClient(self::environment($clientId,$clientSecret));
    }
    public static function environment($clientId,$clientSecret)
    {
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}