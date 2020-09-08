<?php 

use \PHPUnit\Framework\TestCase;

class QueueTest extends TestCase {

    public function testCanAddAnItem() {
        $queue = new Queue;
        $queue->push('ayam');
        $this->assertEquals(1 , $queue->count() );
    }

    public function testCanRemoveAnItem() {
        $queue = new Queue;
        $queue->push('ayam');
        $this->assertEquals(1 , $queue->count() );
        $queue->pop();
        $this->assertEquals(0 , $queue->count() );
    }

    public function testItemIsRemovedFromTheFront() {
        $queue = new Queue;
        $queue->push('ayam');
        $queue->push('ikan');
        $queue->push('apple');
        $queue->push('sabun');
        
        $this->assertEquals('ayam' , $queue->pop() );
        $this->assertEquals('ikan' , $queue->pop() );
        $this->assertEquals('apple' , $queue->pop() );
        $this->assertEquals('sabun' , $queue->pop() );
    }

    public function testCanAddUpToMaxItems() {
        $queue = new Queue;

        for($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            $queue->push($i);
        }

        $this->assertEquals(Queue::MAX_ITEMS, $queue->count() );

        return $queue;

    }

    /**
     * @depends testCanAddUpToMaxItems
     */

    public function testCannotAddMoreThanMaxItems( Queue $queue ) {
//        $this->expectException(QueueException::class);

        $this->expectExceptionMessage("Queue is full");

        $queue->push('ayam');
/*
        $this->assertEquals(Queue::MAX_ITEMS, $queue->count() );

        $queue->push('ikan');
        $this->assertEquals(Queue::MAX_ITEMS, $queue->count() );
*/
    }
}
