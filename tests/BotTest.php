<?php

namespace Pathetic\TgBot\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Pathetic\TgBot\Actions;
use Pathetic\TgBot\Bot;
use Pathetic\TgBot\ReplyMarkupFactory;
use Pathetic\TgBot\Types\Message;
use Pathetic\TgBot\Types\User;
use Pathetic\TgBot\Types\Update;
use Pathetic\TgBot\Types\UserProfilePhotos;

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
    
    public function testSendPhoto()
    {
        $this->assertInstanceOf(Message::class, $this->bot->sendPhoto(321, 'test'));
    }
    
    public function testSendAudio()
    {
        $this->assertInstanceOf(Message::class, $this->bot->sendAudio(321, 'test'));
    }
    
    public function testSendDocument()
    {
        $this->assertInstanceOf(Message::class, $this->bot->sendDocument(321, 'test'));
    }
    
    public function testSendSticker()
    {
        $this->assertInstanceOf(Message::class, $this->bot->sendSticker(321, 'test'));
    }
    
    public function testSendVideo()
    {
        $this->assertInstanceOf(Message::class, $this->bot->sendVideo(321, 'test'));
    }
    
    public function testSendLocation()
    {
        $this->assertInstanceOf(Message::class, $this->bot->sendLocation(123, 41.740104, -71.560718));
    }
    
    public function testSendChatAction()
    {
        $this->assertInstanceOf(Message::class, $this->bot->sendChatAction(321, Actions::TYPING));
    }
    
    public function testGetUserProfilePhotos()
    {
        $this->assertInstanceOf(UserProfilePhotos::class, $this->bot->getUserProfilePhotos(123));
    }
    
    public function testGetUpdates()
    {
        $this->assertEmpty($this->bot->getUpdates());
    }
    
    public function testSetWebhook()
    {
        $this->bot = new Bot('123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11', new Client(['handler' => HandlerStack::create(new MockHandler([
            new Response(200, [], json_encode(['ok' => true, 'result' => true]))
        ]))]));
        
        $this->assertTrue($this->bot->setWebhook());
    }
    
    public function testOn()
    {
        $this->assertInstanceOf(Bot::class, $this->bot->on(
            function (Message $message) {
                return isset($message);
            },
            
            function (Message $message) {
                return isset($message);
            }
        ));
    }
    
    public function testCommand()
    {
        $this->assertInstanceOf(Bot::class, $this->bot->command('test', function(Message $message) {
            return isset($message);
        }));
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
