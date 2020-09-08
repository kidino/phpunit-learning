<?php 

class Queue {

    public const MAX_ITEMS = 5;
    protected $items = [];

    function push($item) {
        if ($this->count() == self::MAX_ITEMS) {
            throw new QueueException("Queue is full");
        }
        $this->items[] = $item;
    }

    function pop() {
        return array_shift($this->items);
    }

    function count() {
        return count($this->items);
    }

    function clear() {
    }

}