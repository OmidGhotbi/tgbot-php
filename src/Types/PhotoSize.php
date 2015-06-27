<?php

namespace Pathetic\TgBot\Types;

class PhotoSize
{
    use \Pathetic\TgBot\TypeInitialization, \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Unique identifier for this file.
     * 
     * @var string
     */
    public $file_id;
    
    /**
     * Photo width.
     * 
     * @var integer
     */
    public $width;
    
    /**
     * Photo height.
     * 
     * @var integer
     */
    public $height;
    
    /**
     * Optional. File size.
     * 
     * @var integer
     */
    public $file_size;
}
