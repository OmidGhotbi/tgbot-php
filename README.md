# tgbot-php

[![Travis](https://img.shields.io/travis/pathetic/tgbot-php.svg?style=flat-square)](https://travis-ci.org/pathetic/tgbot-php)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/pathetic/tgbot-php.svg?style=flat-square)](https://scrutinizer-ci.com/g/pathetic/tgbot-php/)
[![Code Climate](https://img.shields.io/codeclimate/github/pathetic/tgbot-php.svg?style=flat-square)](https://codeclimate.com/github/pathetic/tgbot-php)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/02ba0ee8-9aa7-43f3-8cf0-53e43697843f.svg?style=flat-square)](https://insight.sensiolabs.com/projects/56001e85-e5c1-49df-8a86-7d306cef0183)
[![Codacy](https://img.shields.io/codacy/4db1730bb8084f3bb50f4203b4f1e282.svg?style=flat-square)](https://www.codacy.com/app/pathetic/tgbot-php/dashboard)
[![Packagist](https://img.shields.io/packagist/dt/pathetic/tgbot.svg?style=flat-square)](https://packagist.org/packages/pathetic/tgbot)

If you have any questions, [here i am](https://telegram.me/TotallyNotABot).

# Installation

`composer require pathetic/tgbot`

```json
{
  "require": {
    "pathetic/tgbot": "dev-master"
  }
}
```

# Testing

`composer test`

# Usage

```php
require_once 'vendor/autoload.php';

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

# Usage: /img description
$bot->command('img', function($message, ...$description) use ($bot) {
    if (empty($description)) return;
    # Implode all arguments in one string.
    $description = implode(chr(32), $description);
    
    $images = json_decode(file_get_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=' . urlencode($description) . '&rsz=8'), true)['responseData']['results'];
    $image = fopen($images[array_rand($images)]['unescapedUrl'], 'r');
    
    $bot->sendPhoto($message->chat->id, $image, $description, $message->message_id);
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
