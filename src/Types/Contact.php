<?php

namespace Pathetic\TgBot\Types;

class Contact
{
    use \Pathetic\TgBot\TypeInitialization;
    
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
     * @var string
     */
    public $user_id;
}
