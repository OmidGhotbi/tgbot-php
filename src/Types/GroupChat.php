<?php

namespace Pathetic\TgBot\Types;

class GroupChat
{
    use \Pathetic\TgBot\TypeInitialization;
    
    /**
     * Unique identifier for this group chat.
     * 
     * @var integer
     */
    public $id;
    
    /**
     * Group name.
     * 
     * @var string
     */
    public $title;
}
