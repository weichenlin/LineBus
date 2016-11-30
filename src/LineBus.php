<?php

namespace AZnC\LineBusType76;


use Evenement\EventEmitter;

class LineBus
{
    /**
     * @var EventPublisher
     */
    protected $publisher;

    /**
     * @var EventEmitter
     */
    protected $emitter;

    public function __construct(EventPublisher $publisher)
    {
        $this->publisher = $publisher;
        $this->emitter = new EventEmitter();
    }

    public function on($eventType, callable $handler)
    {
        $this->emitter->on($eventType, $handler);
    }

    public function run()
    {
        $this->publisher->start($this->emitter);
    }
}
