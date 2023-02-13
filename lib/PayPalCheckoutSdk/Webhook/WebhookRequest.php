<?php
namespace PayPalCheckoutSdk\Webhook;

use PayPalHttp\HttpRequest;

class WebhookRequest extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/notifications/verify-webhook-signature?", "POST");
        $this->headers["Content-Type"] = "application/json";
    }
}