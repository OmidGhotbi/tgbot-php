<?php

namespace Pathetic\TgBot\Tests;

use Pathetic\TgBot\Bot;
use Pathetic\TgBot\ReplyMarkupFactory;

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
    
    public function testMake()
    {
        $this->assertInstanceOf(ReplyMarkupFactory::class, $this->bot->make());
    }
}
