<?php 

use \PHPUnit\Framework\TestCase;

class MockTest extends TestCase {

    public function testMock() {
        // $mailer = new Mailer();

        $mockMailer = $this->createMock(Mailer::class);
        $mockMailer->method('sendMessage')->willReturn(true);

        $this->assertTrue( $mockMailer->sendMessage('dino@websegera.my', 'Apa khabar') );
    }

}