<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\Update;
use Pathetic\TgBot\Types\Message;

class UpdateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Update
     */
    protected $update;
    
    public function setUp()
    {
        $this->update = new Update(['update_id' => 123, 'message' => []]);
    }
    
    public function testUpdateId()
    {
        $this->assertAttributeEquals(123, 'update_id', $this->update);
    }
    
    public function testMessage()
    {
        $this->assertAttributeInstanceOf(Message::class, 'message', $this->update);
    }
}
