<?php

namespace Pathetic\TgBot\Tests;

use Pathetic\TgBot\Types\Message;
use Pathetic\TgBot\Types\User;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Message
     */
    protected $message;
    
    public function setUp()
    {
        $this->message = new Message([
            'message_id' => 123,
            'from' => [],
            'date' => 1435350662,
        ]);
    }
    
    public function testMessageId()
    {
        $this->assertAttributeEquals(123, 'message_id', $this->message);
    }
    
    public function testFrom()
    {
        $this->assertInstanceOf(User::class, $this->message->from);
    }
}
