<?php

namespace Fawaterk;

/**
 * Fawaterk Payment Integration.
 * @author Michael Yousrie <michael@fawaterk.com>
 */
class Fawaterk
{
    /**
     * @var string $vendorKey
     */
    private $vendorKey;

    /**
     * @var array $cartItems
     */
    private $cartItems;

    /**
     * @var string $redirectUrl
     */
    private $redirectUrl;

    /**
     * @var float $shipping
     */
    private $shipping;

    /**
     * @var float $cartTotal
     */
    private $cartTotal;

    /**
     * @var array $customer
     */
    private $customer;

    /**
     * @var string $currency
     */
    private $currency;


    /**
     * Set vendor key.
     * @var string $vendorKey
     */
    public function setVendorKey( string $vendorKey )
    {
        $this->vendorKey = $vendorKey;

        return $this;
    }


    /**
     * Set Cart Items
     * @var array $cartItems
     */
    public function setCartItems(array $cartItems)
    {
        $this->cartItems = $cartItems;

        return $this;
    }


    /**
     * set redirect url
     * @var string $redirectUrl
     */
    public function setRedirectUrl( string $redirectUrl )
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }


    /**
     * Set shipping
     * @var float $shipping
     */
    public function setShipping( float $shipping )
    {
        $this->shipping = $shipping;

        return $this;
    }


    /**
     * Set cart total
     * @var float $cartTotal
     */
    public function setCartTotal( float $cartTotal )
    {
        $this->cartTotal = $cartTotal;

        return $this;
    }


    /**
     * Set customer
     * @var array $customer
     */
    public function setCustomer( array $customer )
    {
        $this->customer = $customer;

        return $this;
    }


    /**
     * Set currency
     * @var string $currency
     */
    public function setCurrency( string $currency )
    {
        $this->currency = strtoupper($currency);

        return $this;
    }


    /**
     * Sends the request and gets back the invoice URL.
     */
    public function getInvoiceUrl()
    {
        $data = [
            "vendorKey"     => $this->vendorKey,
            "cartItems"     => $this->cartItems,
            "cartTotal"     => $this->cartTotal,
            'shipping'      => $this->shipping,
            "customer"      => $this->customer,
            'redirectUrl'   => $this->redirectUrl,
            'currency'      => $this->currency
        ];

        $requestHandler = new HttpRequestHandler;

        $response = $requestHandler->send( $data );

        if ( property_exists( $response, 'url' ) )
        {
            return $response->url;
        }

        throw new \Exception("Invalid Response! " . $response);
    }
}
