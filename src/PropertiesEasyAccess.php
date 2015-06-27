<?php

namespace Pathetic\TgBot;

function camel2snake($name) {
    $str_arr = str_split($name);
    foreach ($str_arr as $k => &$v) {
        if (ord($v) >= 64 && ord($v) <= 90) { // A = 64; Z = 90
            $v = strtolower($v);
            $v = ($k != 0) ? '_'.$v : $v;
        }
    }
    return implode('', $str_arr);
}

trait PropertiesEasyAccess
{
    public function __get($property)
    {
        $snakeProperty = camel2snake($property);
        if (isset($this->$snakeProperty)) {
            return $this->$snakeProperty;
        }
        
        if ('id' == $property) {
            switch (get_called_class()) {
                case \Pathetic\TgBot\Types\Audio::class:
                case \Pathetic\TgBot\Types\Document::class:
                case \Pathetic\TgBot\Types\PhotoSize::class:
                case \Pathetic\TgBot\Types\Sticker::class:
                case \Pathetic\TgBot\Types\Video::class:
                    return $this->file_id;
                    
                case \Pathetic\TgBot\Types\Contact::class:
                    return $this->user_id;
                    
                case \Pathetic\TgBot\Types\Message::class:
                    return $this->message_id;
                    
                case \Pathetic\TgBot\Types\Update::class:
                    return $this->update_id;
                    
                default:
                    return null;
                
            }
        }
        
        if ('size' == $property) {
            return $this->file_size;
        }
        
        return null;
    }
}
