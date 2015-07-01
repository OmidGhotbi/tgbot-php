<?php

namespace Pathetic\TgBot\Tests;

use Pathetic\TgBot\Bot;
use Pathetic\TgBot\Types\ForceReply;
use Pathetic\TgBot\Types\ReplyKeyboardMarkup;
use Pathetic\TgBot\Types\ReplyKeyboardHide;

class BotTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Bot
     */
    protected $bot;
    
    public function setUp()
    {
        $this->bot = new Bot('123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11');
    }
    
    public function testCreateUpdateFromRequest()
    {
        $this->assertEmpty($this->bot->createUpdateFromRequest());
    }
    
    public function testForceReply()
    {
        $this->assertInstanceOf(ForceReply::class, $this->bot->forceReply());
    }
    
    public function testReplyKeyboardMarkup()
    {
        $this->assertInstanceOf(ReplyKeyboardMarkup::class, $this->bot->replyKeyboardMarkup([['TEST']]));
    }
    
    public function testReplyKeyboardHide()
    {
        $this->assertInstanceOf(ReplyKeyboardHide::class, $this->bot->replyKeyboardHide());
    }
}
