# PAYPAL - REST API V2

## Prerequisites
- PHP 5.6 and above
- Paypal Developer App <br/>
This needs to integrate with Paypal Payment in our product (website,web-app,etc.) via REST APIs. The PayPal REST API is organized around transaction workflows, including: orders, payments, subscriptions, invoicing, and disputes. 
To get started with the PayPal REST API, first create a developer account on the Developer Dashboard. From there can generate the credentials then keep it safe.
- Create a new App : here
  - Type the App name
  - Select Merchant
  - Select Sandbox Business Account
  - Click the button “Create App”
- After creating the App, create the SANDBOX WEBHOOKS then keep the credentials keys. Set the Webhook listener url : 
 <i>eg. your_endpoint.com/paypal/src/validateWebHook.php</i>


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

