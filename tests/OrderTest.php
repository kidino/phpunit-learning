<?php 

use \PHPUnit\Framework\TestCase;

class OrderTest extends TestCase {

    public function tearDown():void {
        \Mockery::close();
    }

    function testOrderIsProcessed() {
        $gateway = $this->getMockBuilder( 'PaymentGateway' )
                        ->setMethods(['charge'])
                        ->getMock();

        $gateway->method('charge')
                ->with( $this->equalTo(100) )
                ->willReturn(true);

        $order = new Order($gateway);
        $order->amount = 100;
        $this->assertTrue( $order->process() );
    }

    function testWithMockeryOrderIsProcessed() {

        $gateway = Mockery::mock('PaymentGateway');

        $gateway->shouldReceive('charge')
                ->once()
                ->with(100)
                ->andReturn(true);

        $order = new Order($gateway);
        $order->amount = 100;
        $this->assertTrue( $order->process() );

    }
}
