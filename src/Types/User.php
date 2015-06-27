<?php

namespace Pathetic\TgBot\Types;

class User
{
    use \Pathetic\TgBot\TypeInitialization, \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Unique identifier for this user or bot.
     * 
     * @var integer
     */
    public $id;
    
    /**
     * User‘s or bot’s first name.
     * 
     * @var string
     */
    public $first_name;
    
    /**
     * Optional. User‘s or bot’s last name.
     * 
     * @var string
     */
    public $last_name;
    
    /**
     * Optional. User‘s or bot’s username.
     * 
     * @var string
     */
    public $username;
}
