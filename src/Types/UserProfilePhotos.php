<?php

namespace Pathetic\TgBot\Types;

class UserProfilePhotos
{
    use \Pathetic\TgBot\TypeInitialization, \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Total number of profile pictures the target user has.
     * 
     * @var integer
     */
    public $total_count;
    
    /**
     * Requested profile pictures (in up to 4 sizes each).
     * 
     * @var array
     */
    public $photos;
}
