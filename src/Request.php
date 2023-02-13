<?php
use API\Amount;
use API\RedirectUrls;
use API\Order;
use API\PayPalConstants;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Client\Client;

include __DIR__.'/../bootstrap.php';

class Request{
    protected $debug;
    protected $paypalConfig;
    protected $app_mode;

    public function __construct() {
        global $debug;
        global $paypalConfig;
        global $app_mode;
        $this->debug =$debug;
        $this->paypalConfig =& $paypalConfig;
        $this->app_mode =& $app_mode;
    }

    public function build()
    {
        session_start();
        $reqCurrency="SGD";
        $reqInvoice=strtoupper(uniqid());
        $reqAmount=10;
        if (!$this->debug)
        {
            if(isset($_POST['currency'])&&isset($_POST['invoice_no'])&&isset($_POST['set_amount'])){
                $reqCurrency=$_POST['currency'];
                $reqInvoice=$_POST['invoice_no'];
                $reqAmount=$_POST['set_amount'];
            }
        }
        $amount=new Amount();
        $amount->setCurrency($reqCurrency)
               ->setTotal($reqAmount);
        $redirect_urls=new RedirectUrls();
        $redirect_urls->setReturnUrl($this->paypalConfig['return_url'])
                      ->setCancelUrl($this->paypalConfig['cancel_url']);
        $invoiceId=$reqInvoice=="JUDGIFY-"?"JUDGIFY-".strtoupper(uniqid()):$reqInvoice;
        $order=new Order();
        $order->setIntent('CAPTURE')
              ->setInvoiceId($invoiceId)
              ->buildOrder();
        return $_SESSION['order'];
    }
    public function create()
    {   
        $clientId=$this->paypalConfig['client_id'];
        $clientSecret=$this->paypalConfig['client_secret'];
        try {
            $request = new OrdersCreateRequest();
            $request->headers["prefer"] = "return=representation";
            $request->body =self::build();
            $client = Client::make($clientId,$clientSecret,$this->app_mode);
            $response = $client->execute($request);
            session_abort();

            $dir=__DIR__.'/../temp/OrdersCreated/';
            if( !is_dir( $dir ) )
                mkdir( $dir, 0777, true );
            $data=json_encode($response);
            $invoice_id=$response->result->purchase_units[0]->invoice_id;
            file_put_contents($dir.'order-created-response-'.$invoice_id.'.json',$data);
        } catch (Exception $e) {
            session_abort();
            $dir=__DIR__.'/../temp/OrdersCreatErrors/';
            if( !is_dir( $dir ) )
                mkdir( $dir, 0777, true );
            file_put_contents($dir.'order-create-error-'.date('Ymd-His').'.txt',$e);
            exit(1);
        }
        if ($this->debug)
        {
            print "Status Code: {$response->statusCode}\n";
            print "Status: {$response->result->status}\n";
            print "Order ID: {$response->result->id}\n";
            print "Intent: {$response->result->intent}\n";
            print "Links:\n";
            foreach($response->result->links as $link)
            {
                print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            // To toggle printing the whole response body comment/uncomment below line
            echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";
            exit(1);
        }
        $this->links=$response->result->links;
        header('location:' . self::getApprovalLink());
        exit(1);
    }
    public function getApprovalLink()
    {
        return $this->getLink(PayPalConstants::APPROVE);
    }
    public function getLink($rel)
    {
        if (is_array($this->links)) {
            foreach ($this->links as $link) {
                if ($link->rel == $rel) {
                    return $link->href;
                }
            }
        }
        return null;
    }
}

$request=new Request();
$request->create();
// $request->create($debug);