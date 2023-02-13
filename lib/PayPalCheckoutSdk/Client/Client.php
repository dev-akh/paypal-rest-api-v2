<?php
namespace PayPalCheckoutSdk\Client;

use PayPalCheckoutSdk\Client\PaypalClient;
use PayPalCheckoutSdk\Client\PaypalProductionClient;
class Client{
    public static function make($clientId,$clientSecret,$mode='sandbox')
    {
        if($mode=='live')
         return PaypalProductionClient::client($clientId,$clientSecret);
        else
         return PaypalClient::client($clientId,$clientSecret);
        
    }
}
