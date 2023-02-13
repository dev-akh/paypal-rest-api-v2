<?php
namespace API;

use API\Validator\UrlValidator;

class RedirectUrls{
    public function setReturnUrl($return_url)
    {
        UrlValidator::validate($return_url, "ReturnUrl");
        $_SESSION['return_url'] = $return_url;
        return $this;
    }

    /**
     * Url where the payer would be redirected to after approving the payment. **Required for PayPal account payments.**
     *
     * @return string
     */
    public function getReturnUrl()
    {
        return $_SESSION['return_url'];
    }

    /**
     * Url where the payer would be redirected to after canceling the payment. **Required for PayPal account payments.**
     *
     * @param string $cancel_url
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setCancelUrl($cancel_url)
    {
        UrlValidator::validate($cancel_url, "CancelUrl");
        $_SESSION['cancel_url'] = $cancel_url;
        return $this;
    }

    /**
     * Url where the payer would be redirected to after canceling the payment. **Required for PayPal account payments.**
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $_SESSION['cancel_url'];
    }
}