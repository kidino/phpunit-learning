<?php 

use \PHPUnit\Framework\TestCase;

class OrderTest extends TestCase {

    function testOrderIsProcessed() {
        $gateway = $this->createMock( 'PaymentGateway' );

        $order = new Order($gateway);

        $order->amount = 100;

        $this->assertTrue(  $order->process() );
    }
}
