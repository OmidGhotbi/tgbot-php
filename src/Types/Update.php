<?php

namespace Pathetic\TgBot\Types;

class Update
{
    use \Pathetic\TgBot\TypeInitialization, \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * The update‘s unique identifier. Update identifiers start from a certain positive number and increase sequentially.
     * This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order.
     * 
     * @var integer
     */
    public $update_id;
    
    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     * 
     * @var \Pathetic\TgBot\Types\Message
     */
    public $message;
}
