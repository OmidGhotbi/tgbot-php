<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\GroupChat;

class GroupChatTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\GroupChat
     */
    public $groupChat;
    
    public function setUp()
    {
        $this->groupChat = new GroupChat(['id' => -19269926, 'title' => 'Bot Dev Test Group']);
    }
    
    public function testId()
    {
        $this->assertAttributeEquals(-19269926, 'id', $this->groupChat);
    }
    
    public function testTitle()
    {
        $this->assertAttributeEquals('Bot Dev Test Group', 'title', $this->groupChat);
    }
}
