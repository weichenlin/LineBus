# LineBus

## example
most work are done by the LineBus, you could focus on the event. 
the official echo bot can be simplify like:
```
$bus = LineBusFactory::CreateBus($token, $secret);
$bus->on('message.text', function ($event, $bot) {
    $bot->replyText($event->getReplyToken(), $event->getText());
});

$bus->run();
```

when there are something bad happens, LineBus fire a exception event that you can used to write log:
```
$bus->on('exception', function ($exception, $request, $signature) use ($logger) {
    $logger->log("something bad happens: {$exception->getMessage()}");
    $logger->log("signature: $signature, request body: $request");
});
```