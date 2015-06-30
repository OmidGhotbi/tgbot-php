<?php

namespace Pathetic\TgBot;

use Pathetic\TgBot\Types\Message;

class MessageTypes
{
    public static function text($check = null)
    {
        return function(Message $message) use ($check) {
            if (!isset($message->text)) {
                return false;
            }
            
            if (null === $check || !is_callable($check)) {
                return true;
            }
            
            return $check($message);
        };
    }
}
