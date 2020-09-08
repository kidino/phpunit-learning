<?php 

class ExampleTest extends \PHPUnit\Framework\TestCase {
    public function testAddingTwoPlusTwoIsFour() {
        $this->assertEquals(4, 2 + 2);
    }

    public function testFiveMinusTwoIsThree() {
        $this->assertEquals(4, 5 - 2);
    }

    public function testHelloworld() {
        $this->assertEquals(5, 5 - 0);
    }

    public function testAddFunction() {
        require "functions.php";

        $this->assertEquals(4, add(2,3));
        $this->assertEquals(15, add(7,8));
        $this->assertEquals(4, add(10,10));
    }

    public function testMinusFunction() {
        $this->assertEquals(-1, minus(2,3));
        $this->assertEquals(-1, minus(7,8));
        $this->assertEquals(9, minus(17,8));
        $this->assertEquals(0, minus(10,10));

    }
}
