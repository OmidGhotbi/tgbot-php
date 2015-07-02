<?php

namespace Pathetic\TgBot\Tests;

use Pathetic\TgBot\EventSystem;
use Pathetic\TgBot\Types\Message;

class EventSystemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\EventSystem
     */
    protected $eventSystem;
    
    public function setUp()
    {
        $this->eventSystem = new EventSystem();
    }
    
    public function testAdd()
    {
        $this->eventSystem->add(
            function(Message $message) {
                return true;
            },
            
            function(Message $message) {
                return true;
            }
        );
        
        $this->assertAttributeNotEmpty('events', $this->eventSystem);
    }
}
