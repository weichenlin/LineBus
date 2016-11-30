# 七六式 LineBus
幫你簡化使用 Line Bot SDK 的流程。

## 範例
大部分的準備工作都會由 LineBus 替你完成，你只需要專注在處理 Line 丟過來的事件。
官方提供的 Echo Bot 範例若使用 LineBus 改寫，可以簡化成以下的程式碼：
```
$bus = LineBusFactory::CreateBus($token, $secret);
$bus->on('message.text', function ($event, $bot) {
    $bot->replyText($event->getReplyToken(), $event->getText());
});

$bus->run();
```

如果在準備工作階段發生了任何錯誤，LineBus 會丟出一個 exception 事件，你可以用這個事件來紀錄一些訊息：
```
$bus->on('exception', function ($exception, $request, $signature) use ($logger) {
    $logger->log("something bad happens: {$exception->getMessage()}");
    $logger->log("signature: $signature, request body: $request");
});
```

## 安裝
使用 composer：
```
$ composer require aznc/line_bus_type76
```