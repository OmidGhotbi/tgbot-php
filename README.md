# tgbot-php

[![Scrutinizer](https://img.shields.io/scrutinizer/g/pathetic/tgbot-php.svg?style=flat-square)](https://scrutinizer-ci.com/g/pathetic/tgbot-php/)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/02ba0ee8-9aa7-43f3-8cf0-53e43697843f.svg?style=flat-square)](https://insight.sensiolabs.com/projects/56001e85-e5c1-49df-8a86-7d306cef0183)
[![Packagist](https://img.shields.io/packagist/dt/pathetic/tgbot.svg?style=flat-square)](https://packagist.org/packages/pathetic/tgbot)

# Installation

`composer require pathetic/tgbot`

```json
{
  "require": {
    "pathetic/tgbot": "dev-master
  }
}
```

# Usage

```php
use Pathetic\TgBot\Bot as TgBot;

$bot = new TgBot('token');

# Commands

# Usage: /echo "something"
# You can even use default values: function($message, $something = "I don't know what to say.") {}
$bot->command('echo', function($message, $something) use ($bot) {
    # You can use $message->from->firstName instead of $message->from->first_name
    $bot->sendMessage($message->chat->id, $message->from->first_name . " says: $something");
});

# Usage: /sum 1 2 3
$bot->command('sum', function($message, ...$numbers) use ($bot) {
    $result = 0;
    
    foreach ($numbers as $number) {
        $result += (int) $number;
    }
    
    # You can use $message->id instead of $message->message_id
    $bot->sendMessage($message->chat->id, $result, null, $message->message_id);
});

# Events

$bot->on(
    function($message) {
        # If you are the sender of current message, this will return true.
        return 'YourUsername' == $message->from->username;
    },
    
    # This function will be executed if previous returned true.
    function($message) use ($bot) {
        # Reply to message.
        $bot->sendMessage($message->chat->id, 'I love you.', null, $message->id);
        
        # If this function will return false, the cycle will be broken so no other events for current message will be triggered.
        return false;
    }
);

# Updates handling

# Webhook
$bot->handle($bot->createUpdateFromRequest());

# Long polling
# This file should be runned as daemon.
while (true) {
    $bot->handle($bot->getUpdates());
    sleep(3);
}

```
