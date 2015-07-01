<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\ReplyKeyboardMarkup;

class ReplyKeyboardMarkupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\ReplyKeyboardMarkup
     */
    protected $replyKeyboardMarkup;
    
    public function setUp()
    {
        $this->replyKeyboardMarkup = new ReplyKeyboardMarkup([['A', 'B'], ['C', 'D']], ['resize_keyboard' => true, 'one_time_keyboard' => true]);
    }
    
    public function testKeyboard()
    {
        $this->assertAttributeNotEmpty('keyboard', $this->replyKeyboardMarkup);
    }
    
    public function testResizeKeyboard()
    {
        $this->assertAttributeEquals(true, 'resize_keyboard', $this->replyKeyboardMarkup);
    }
    
    public function testOneTimeKeyboard()
    {
        $this->assertAttributeEquals(true, 'one_time_keyboard', $this->replyKeyboardMarkup);
    }
    
    public function testSelective()
    {
        $this->assertAttributeEquals(false, 'selective', $this->replyKeyboardMarkup);
    }
}
