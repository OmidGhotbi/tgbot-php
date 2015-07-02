<?php

namespace Pathetic\TgBot\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Pathetic\TgBot\Bot;
use Pathetic\TgBot\ReplyMarkupFactory;
use Pathetic\TgBot\Types\Message;
use Pathetic\TgBot\Types\User;

class BotTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Bot
     */
    protected $bot;
    
    public function setUp()
    {
        $this->bot = new Bot('123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11', new Client(['handler' => HandlerStack::create(new MockHandler([
            new Response(200, [], json_encode(['ok' => true, 'result' => []]))
        ]))]));
    }
    
    public function testGetMe()
    {
        $this->assertInstanceOf(User::class, $this->bot->getMe());
    }
    
    public function testSendMessage()
    {
        $this->assertInstanceOf(Message::class, $this->bot->sendMessage(123, 'test'));
    }
    
    public function testForwardMessage()
    {
        $this->assertInstanceOf(Message::class, $this->bot->forwardMessage(321, 321, 123));
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
