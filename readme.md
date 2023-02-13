# PAYPAL - REST API V2

## Prerequisites
- PHP 5.6 and above

## Configuration 
- rename `.env.example` to `.env`

DEBUG=false <i>// (boolean) make `true` if wish to run in terminal</i>

APP_MODE='sandbox' <i>// Current test in Sandbox account</i>

PAYPAL_CLIENT_ID=`<<Paypal-Client-Id>>` <br/>
PAYPAL_CLIENT_SECRET= `<<Paypal-Client-Secret>>` <br/>
PAYPAL_WEBHOOK_ID=`<<Webhook-Id>>` <br/>

PAYPAL_LIVE_CLIENT_ID=`<<Paypal-Live-Client-Id>>` <br/>
PAYPAL_LIVE_CLIENT_SECRET= `<<Paypal-Live-Client-Secret>>` <br/>
PAYPAL_LIVE_WEBHOOK_ID=`<<Live-Webhook-Id>>` <br/>

PAYPAL_RETURN_URL='/Response.php' <i> // Return Url</i> <br/>
PAYPAL_CANCEL_URL='/payment-cancelled.html' <i>// Cancel url </i> <br/>
PAYPAL_SUCCESS_URL='/payment-successful.html' <i>// Successful url </i> <br/>

## Installation
- `composer install`
## Generating autoload-load files
- `composer dump-autoload` 
## Reference Github
- (Checkout-PHP-SDK) [https://github.com/paypal/Checkout-PHP-SDK]
## Remark 
See the log files in the `/temp` directory.
- /temp/OrdersCreated
- /temp/OrdersCaptured
- /temp/WebhookEvents

