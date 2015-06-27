<?php

namespace Pathetic\TgBot\Types;

class Location
{
    use \Pathetic\TgBot\TypeInitialization;
    
    /**
     * Longitude as defined by sender.
     * 
     * @var float
     */
    public $longitude;
    
    /**
     * Latitude as defined by sender.
     * 
     * @var float
     */
    public $latitude;
}
