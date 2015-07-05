<?php

namespace Pathetic\TgBot;

use Pathetic\TgBot\Types\User;
use Pathetic\TgBot\Types\GroupChat;
use Pathetic\TgBot\Types\Message;
use Pathetic\TgBot\Types\Audio;
use Pathetic\TgBot\Types\Document;
use Pathetic\TgBot\Types\Sticker;
use Pathetic\TgBot\Types\Video;
use Pathetic\TgBot\Types\Contact;
use Pathetic\TgBot\Types\Location;
use Pathetic\TgBot\Types\PhotoSize;

trait TypeInitialization
{
    public function __construct($properties)
    {
        $needToBeConvertedInObject = [
            'message' => Message::class,
            'from' => User::class,
            'chat' => [User::class, GroupChat::class],
            'forward_from' => User::class,
            'reply_to_message' => Message::class,
            'audio' => Audio::class,
            'document' => Document::class,
            'photo' => [PhotoSize::class],
            'photos' => [PhotoSize::class],
            'sticker' => Sticker::class,
            'video' => Video::class,
            'contact' => Contact::class,
            'location' => Location::class,
            'new_chat_participant' => User::class,
            'left_chat_participant' => User::class,
            'new_chat_photo' => [PhotoSize::class],
            'thumb' => PhotoSize::class
        ];
        
        foreach ($properties as $property => $value) {
            if (null !== $value) {
                if (isset($needToBeConvertedInObject[$property])) {
                    if (is_array($needToBeConvertedInObject[$property])) {
                        switch ($property) {
                            case 'chat':
                                if (isset($value['title'])) {
                                    $this->$property = new $needToBeConvertedInObject[$property][1]($value);
                                } else {
                                    $this->$property = new $needToBeConvertedInObject[$property][0]($value);
                                }
                                break;
                                
                            case 'photo':
                            case 'new_chat_photo':
                                $photos = [];
                                
                                foreach ($value as $photoSize) {
                                    $photos[] = new $needToBeConvertedInObject[$property][0]($photoSize);
                                };

                                $this->$property = $photos;
                                break;
                                
                            case 'photos':
                                $photos = [];
                                
                                foreach ($value as $photoSize) {
                                    $nestedArray = [];
                                    foreach ($photoSize as $photoArray) {
                                        $nestedArray[] = new $needToBeConvertedInObject[$property][0]($photoArray);
                                    }
                                    $photos[] = $nestedArray;
                                };

                                $this->$property = $photos;
                                break;
                        }
                    } else {
                        $this->$property = new $needToBeConvertedInObject[$property]($value);
                    }
                } else {
                    $this->$property = $value;
                }
            }
        }
    }
}
