<?php

namespace Pathetic\TgBot\Types;

class Message
{
    use \Pathetic\TgBot\TypeInitialization;
    
    /**
     * Unique message identifier.
     * 
     * @var integer
     */
    public $message_id;
    
    /**
     * Sender.
     * 
     * @var \Pathetic\TgBot\Types\User
     */
    public $from;
    
    /**
     * Date the message was sent in Unix time.
     * 
     * @var integer
     */
    public $date;
    
    /**
     * Conversation the message belongs to — user in case of a private message, GroupChat in case of a group.
     * 
     * @var \Pathetic\TgBot\Types\User|\Pathetic\TgBot\Types\GroupChat
     */
    public $chat;
    
    /**
     * Optional. For forwarded messages, sender of the original message.
     * 
     * @var \Pathetic\TgBot\Types\User
     */
    public $forward_from;
    
    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time.
     * 
     * @var string
     */
    public $forward_date;
    
    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     * 
     * @var \Pathetic\TgBot\Types\Message
     */
    public $reply_to_message;
    
    /**
     * Optional. For text messages, the actual UTF-8 text of the message.
     * 
     * @var string
     */
    public $text;
    
    /**
     * Optional. Message is an audio file, information about the file.
     * 
     * @var \Pathetic\TgBot\Types\Audio
     */
    public $audio;
    
    /**
     * Optional. Message is a general file, information about the file.
     * 
     * @var \Pathetic\TgBot\Types\Docuemnt
     */
    public $document;
    
    /**
     * Optional. Message is a photo, available sizes of the photo.
     * 
     * @var array
     */
    public $photo;
    
    /**
     * Optional. Message is a sticker, information about the sticker.
     * 
     * @var \Pathetic\TgBot\Types\Sticker
     */
    public $sticker;
    
    /**
     * Optional. Message is a video, information about the video.
     * 
     * @var \Pathetic\TgBot\Types\Video
     */
    public $video;
    
    /**
     * Optional. Message is a shared contact, information about the contact.
     * 
     * @var \Pathetic\TgBot\Types\Contact
     */
    public $contact;
    
    /**
     * Optional. Message is a shared location, information about the location.
     * 
     * @var \Pathetic\TgBot\Types\Location
     */
    public $location;
    
    /**
     * Optional. A new member was added to the group, information about them (this member may be bot itself).
     * 
     * @var \Pathetic\TgBot\Types\User
     */
    public $new_chat_participant;
    
    /**
     * Optional. A member was removed from the group, information about them (this member may be bot itself).
     * 
     * @var \Pathetic\TgBot\Types\User
     */
    public $left_chat_participant;
    
    /**
     * Optional. A group title was changed to this value.
     * 
     * @var string
     */
    public $new_chat_title;
    
    /**
     * Optional. A group photo was change to this value.
     * 
     * @var array
     */
    public $new_chat_photo;
    
    /**
     * Optional. Informs that the group photo was deleted.
     * 
     * @var boolean
     */
    public $delete_chat_photo;
    
    /**
     * Optional. Informs that the group has been created.
     * 
     * @var boolean
     */
    public $group_chat_created;
}
