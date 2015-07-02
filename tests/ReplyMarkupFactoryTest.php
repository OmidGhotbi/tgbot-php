<?php

namespace Pathetic\TgBot\Tests;

use Pathetic\TgBot\ReplyMarkupFactory;
use Pathetic\TgBot\Types\ForceReply;
use Pathetic\TgBot\Types\ReplyKeyboardMarkup;
use Pathetic\TgBot\Types\ReplyKeyboardHide;

class ReplyMarkupFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\ReplyMarkupFactory
     */
    protected $replyMarkupFactory;
    
    public function setUp()
    {
        $this->replyMarkupFactory = new ReplyMarkupFactory();
    }
    
    public function testForceReply()
    {
        $this->assertInstanceOf(ForceReply::class, $this->replyMarkupFactory->forceReply());
    }
    
    public function testReplyKeyboardMarkup()
    {
        $this->assertInstanceOf(ReplyKeyboardMarkup::class, $this->replyMarkupFactory->replyKeyboardMarkup([['TEST']]));
    }
    
    public function testReplyKeyboardHide()
    {
        $this->assertInstanceOf(ReplyKeyboardHide::class, $this->replyMarkupFactory->replyKeyboardHide());
    }
}
