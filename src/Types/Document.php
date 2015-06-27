<?php

namespace Pathetic\TgBot\Types;

class Document
{
    use \Pathetic\TgBot\TypeInitialization, \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Unique file identifier.
     * 
     * @var string
     */
    public $file_id;
    
    /**
     * Document thumbnail as defined by sender.
     * 
     * @var \Pathetic\TgBot\Types\PhotoSize
     */
    public $thumb;
    
    /**
     * Optional. Original filename as defined by sender.
     * 
     * @var string
     */
    public $file_name;
    
    /**
     * Optional. MIME type of the file as defined by sender.
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
