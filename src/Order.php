<?php 

class Order {

    public $amount = 0;
    protected $gateway;

    function __construct( PaymentGateway $gateway ) {
        $this->gateway = $gateway;
    }

    function process() {

        return $this->gateway->charge( $this->amount );

    }
}