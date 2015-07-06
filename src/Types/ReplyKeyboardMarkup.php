<?php

namespace Pathetic\TgBot\Types;

class ReplyKeyboardMarkup implements \JsonSerializable
{
    use \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Array of button rows, each represented by an Array of Strings.
     * 
     * @var array
     */
    public $keyboard;
    
    /**
     * Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons).
     * Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     * 
     * @var boolean
     */
    public $resize_keyboard = false;
    
    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     * 
     * @var boolean
     */
    public $one_time_keyboard = false;
    
    /**
     * Optional. Use this parameter if you want to show the keyboard to specific users only. Targets:
     *  1) users that are @mentioned in the text of the Message object;
     *  2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * 
     * Example: A user requests to change the bot‘s language, bot replies to the request with a keyboard to select the new language. Other users in the group don’t see the keyboard.
     * 
     * @var boolean
     */
    public $selective = false;
    
    /**
     * @param array $keyboard array of arrays
     * @param array $options
     */
    public function __construct(array $keyboard, array $options = [])
    {
        $this->keyboard = $keyboard;
        
        if (isset($options['resize_keyboard'])) {
            $this->resize_keyboard = (boolean) $options['resize_keyboard'];
        }
        
        if (isset($options['one_time_keyboard'])) {
            $this->one_time_keyboard = (boolean) $options['one_time_keyboard'];
        }
        
        if (isset($options['selective'])) {
            $this->selective = (boolean) $options['selective'];
        }
    }
    
    public function jsonSerialize()
    {
        return [
            'keyboard' => $this->keyboard,
            'resize_keyboard' => $this->resize_keyboard,
            'one_time_keyboard' => $this->one_time_keyboard,
            'selective' => $this->selective
        ];
    }
}
