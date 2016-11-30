<?php

namespace AZnC\LineBusType76;


use Evenement\EventEmitter;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class EventPublisher
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $secret;

    public function __construct(Request $request, $token, $secret)
    {
        $this->request = $request;
    }

    public function start(EventEmitter $emitter)
    {
        $requestBody = $this->request->getRequestBody();
        $signature = $this->request->getSignature();

        try {
            $bot = new LINEBot(new CurlHTTPClient($this->token), ['channelSecret' => $this->secret]);
            $events = $bot->parseEventRequest($requestBody, $signature);

            foreach ($events as $event) {
                if ($event->getType() === 'message' && $event instanceof MessageEvent) {
                    $eventType = "message.{$event->getMessageType()}";
                    $emitter->emit($eventType, [$event, $bot]);
                } else {
                    $emitter->emit($event->getType(), [$event, $bot]);
                }
            }
        } catch (\Exception $e) {
            $emitter->emit('exception', [$e, $requestBody, $signature]);
        }
    }
}
