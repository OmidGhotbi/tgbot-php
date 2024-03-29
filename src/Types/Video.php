<?php

namespace Pathetic\TgBot\Types;

class Video
{
    use \Pathetic\TgBot\TypeInitialization, \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Unique identifier for this file.
     * 
     * @var string
     */
    public $file_id;
    
    /**
     * Video width as defined by sender.
     * 
     * @var integer
     */
    public $width;
    
    /**
     * Video height as defined by sender.
     * 
     * @var integer
     */
    public $height;
    
    /**
     * Duration of the video in seconds as defined by sender.
     * 
     * @var integer
     */
    public $duration;
    
    /**
     * Video thumbnail.
     * 
     * @var \Pathetic\TgBot\Types\PhotoSize
     */
    public $thumb;
    
    /**
     * Optional. Mime type of a file as defined by sender.
     * 
     * @var string
     */
    public $mime_type;
    
    /**
     * Optional. File size.
     * 
     * @var integer
     */
    public $file_size;
}
