<?php
namespace API;

use API\Validator\NumericValidator;

class Amount{
    /**
     * 3-letter [currency code](https://developer.paypal.com/docs/integration/direct/rest_api_payment_country_currency_support/). PayPal does not support all currencies.
     *
     * @param string $currency
     * 
     * @return $this
     */
    public function setCurrency($currency)
    {
        $_SESSION['currency']=$currency;
        return $this;
    }

    public function getCurrency()
    {
        return $_SESSION['currency'];
    }

     /**
     * Total amount charged from the payer to the payee. In case of a refund, this is the refunded amount to the original payer from the payee. 10 characters max with support for 2 decimal places.
     *
     * @param string|double $total
     * 
     * @return $this
     */
    public function setTotal($total)
    {
        NumericValidator::validate($total, "Total");
        $total = self::formatToPrice($total, $this->getCurrency());
        $_SESSION['total'] = $total;
        return $this;
    }
    public function getTotal()
    {
        return $_SESSION['total'];
    }

    /**
     * Shipping amount charged from the payer to the payee.  *
     * @param string|double $shippinig_amount
     * 
     * @return $this
     */
    public function setShippingAmount($shipping_amount)
    {
        NumericValidator::validate($shipping_amount, "Shipping Amount");
        $shipping_amount =self::formatToPrice($shipping_amount, $this->getCurrency());
        $_SESSION['shipping_amount'] = $shipping_amount;
        return $this;
    }
    public function getShippingAmount()
    {
        return $_SESSION['shipping_amount'];
    }
    /**
     * Tax Total amount charged from the payer to the payee.  *
     * @param string|double $tax_total
     * 
     * @return $this
     */
    public function setTaxTotal($tax_total)
    {
        NumericValidator::validate($tax_total, "Tax Total");
        $tax_total = self::formatToPrice($tax_total, $this->getCurrency());
        $_SESSION['tax_total'] = $tax_total;
        return $this;
    }
    public function getTaxTotal()
    {
        return $_SESSION['tax_total'];
    }
    /**
     * Shipping Discount amount charged from the payer to the payee.  *
     * @param string|double $shipping_discount
     * 
     * @return $this
     */
    public function setShippingDiscount($shipping_discount)
    {
        NumericValidator::validate($shipping_discount, "Shipping Discount");
        $shipping_discount = self::formatToPrice($shipping_discount, $this->getCurrency());
        $_SESSION['shipping_discount'] = $shipping_discount;
        return $this;
    }
    public function getShippingDiscount()
    {
        return $_SESSION['shipping_discount'];
    }

    public function formatToPrice($value, $currency = null)
    {
        $decimals = 2;
        $currencyDecimals = array('JPY' => 0, 'TWD' => 0, 'HUF' => 0);
        if ($currency && array_key_exists($currency, $currencyDecimals)) {
            if (strpos($value, ".") !== false && (floor($value) != $value)) {
                //throw exception if it has decimal values for JPY, TWD and HUF which does not ends with .00
                throw new \InvalidArgumentException("value cannot have decimals for $currency currency");
            }
            $decimals = $currencyDecimals[$currency];
        } elseif (strpos($value, ".") === false) {
            // Check if value has decimal values. If not no need to assign 2 decimals with .00 at the end
            $decimals = 0;
        }
        return self::formatToNumber($value, $decimals);
    }
    public function formatToNumber($value, $decimals = 2)
    {
        if (trim($value) != null) {
            return number_format($value, $decimals, '.', '');
        }
        return null;
    }
}

?>