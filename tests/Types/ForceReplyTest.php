<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\ForceReply;

class ForceReplyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\ForceReply
     */
    protected $forceReply;
    
    public function setUp()
    {
        $this->forceReply = new ForceReply();
    }
    
    public function testForceReply()
    {
        $this->assertAttributeEquals(true, 'force_reply', $this->forceReply);
    }
    
    public function testSelective()
    {
        $this->assertAttributeEquals(false, 'selective', $this->forceReply);
    }
}
