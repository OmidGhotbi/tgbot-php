<?php

namespace Pathetic\TgBot\Types;

class Contact
{
    use \Pathetic\TgBot\TypeInitialization, \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Contact's phone number.
     * 
     * @var string
     */
    public $phone_number;
    
    /**
     * Contact's first name.
     * 
     * @var string
     */
    public $first_name;
    
    /**
     * Optional. Contact's last name.
     * 
     * @var string
     */
    public $last_name;
    
    /**
     * Optional. Contact's user identifier in Telegram.
     * 
     * @var integer
     */
    public $user_id;
}
