<?php
namespace API;

class Order{

    public function setIntent($intent)
    {
       $_SESSION['intent'] = $intent;
        return $this;
    }
    public function getIntent()
    {
        return$_SESSION['intent'];
    }
    public function setInvoiceId($invoice_id)
    {
       $_SESSION['invoice_id']=$invoice_id;
        return $this;
    }
    public function getInvoiceId()
    {
        return $_SESSION['invoice_id'];
    }
    public function purchase_units()
    {
        $purchase_units=array(
            array(
            'invoice_id'=>self::getInvoiceId(),
            'reference_id' => 'PUHF',
            'amount'=>array(
                'currency_code' =>$_SESSION['currency'],
                'value' =>$_SESSION['total'],
            )
        ));
       $_SESSION['purchase_units']=$purchase_units;
        return $purchase_units;
    }
    public function buildOrder()
    {
        $build=array(
            'intent' => self::getIntent(),
            'application_context' =>
                array(
                    'return_url' =>$_SESSION['return_url'],
                    'cancel_url' =>$_SESSION['cancel_url'],
                    'user_action' => 'PAY_NOW',
                    'locale' => 'en-US',
                    'landing_page' => 'BILLING',
                    'user_action' => 'PAY_NOW'
                ),
            'purchase_units'=>self::purchase_units()
        );
       $_SESSION['order']=$build;
        return $this;
    }

    public function create($invoice_id)
    {
        $request = new OrdersCreateRequest();
    }
}