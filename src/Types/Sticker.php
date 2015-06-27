<?php

namespace Pathetic\TgBot\Types;

class Sticker
{
    use \Pathetic\TgBot\TypeInitialization, \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Unique identifier for this file.
     * 
     * @var string
     */
    public $file_id;
    
    /**
     * Sticker width.
     * 
     * @var integer
     */
    public $width;
    
    /**
     * Sticker height.
     * 
     * @var integer
     */
    public $height;
    
    /**
     * Sticker thumbnail in .webp or .jpg format.
     * 
     * @var \Pathetic\TgBot\Types\PhotoSize
     */
    public $thumb;
    
    /**
     * Optional. File size.
     * 
     * @var integer
     */
    public $file_size;
}
