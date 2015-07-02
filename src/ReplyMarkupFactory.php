<?php

namespace Pathetic\TgBot;

use Pathetic\TgBot\Types\ForceReply;
use Pathetic\TgBot\Types\ReplyKeyboardMarkup;
use Pathetic\TgBot\Types\ReplyKeyboardHide;

class ReplyMarkupFactory
{
    /**
     * @param boolean $selective
     * 
     * @return \Pathetic\TgBot\Types\ForceReply
     */
    public function forceReply($selective = false)
    {
        return new ForceReply($selective);
    }
    
    /**
     * @param array $keyboard
     * @param array $options
     * 
     * @return \Pathetic\TgBot\Types\ReplyKeyboardMarkup
     */
    public function replyKeyboardMarkup(array $keyboard, array $options = [])
    {
        return new ReplyKeyboardMarkup($keyboard, $options);
    }
    
    /**
     * @param boolean $selective
     * 
     * @return \Pathetic\TgBot\Types\ReplyKeyboardHide
     */
    public function replyKeyboardHide($selective = false)
    {
        return new ReplyKeyboardHide($selective);
    }
}
