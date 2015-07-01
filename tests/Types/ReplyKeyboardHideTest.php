<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\ReplyKeyboardHide;

class ReplyKeyboardHideTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\ReplyKeyboardHide
     */
    protected $replyKeyboardHide;
    
    public function setUp()
    {
        $this->replyKeyboardHide = new ReplyKeyboardHide();
    }
    
    public function testHideKeyboard()
    {
        $this->assertAttributeEquals(true, 'hide_keyboard', $this->replyKeyboardHide);
    }
    
    public function testSelective()
    {
        $this->assertAttributeEquals(false, 'selective', $this->replyKeyboardHide);
    }
}
