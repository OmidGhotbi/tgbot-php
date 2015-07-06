<?php

namespace Pathetic\TgBot\Types;

class ReplyKeyboardHide implements \JsonSerializable
{
    use \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Requests clients to hide the custom keyboard.
     * 
     * @var boolean
     */
    protected $hide_keyboard = true;
    
    /**
     * Optional. Use this parameter if you want to hide keyboard for specific users only. Targets:
     *  1) users that are @mentioned in the text of the Message object;
     *  2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * 
     * Example: A user votes in a poll, bot returns confirmation message in reply to the vote and hides keyboard for that user, while still showing the keyboard with poll options to users who haven't voted yet.
     * 
     * @var boolean
     */
    protected $selective;
    
    /**
     * @param boolean $selective
     */
    public function __construct($selective = false)
    {
        $this->selective = (boolean) $selective;
    }
    
    public function jsonSerialize()
    {
        return [
            'hide_keyboard' => $this->hide_keyboard,
            'selctive' => $this->selective
        ];
    }
}
