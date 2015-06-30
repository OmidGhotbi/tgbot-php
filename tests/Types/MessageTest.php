<?php

namespace Pathetic\TgBot\Tests;

use Pathetic\TgBot\Types\Message;
use Pathetic\TgBot\Types\User;
use Pathetic\TgBot\Types\GroupChat;
use Pathetic\TgBot\Types\Audio;
use Pathetic\TgBot\Types\Document;
use Pathetic\TgBot\Types\Photo;
use Pathetic\TgBot\Types\Sticker;
use Pathetic\TgBot\Types\Video;
use Pathetic\TgBot\Types\Contact;
use Pathetic\TgBot\Types\Location;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Message
     */
    protected $message;
    
    public function setUp()
    {
        $this->message = new Message([
            'message_id' => 123,
            'from' => ['id' => 1245125, 'first_name' => 'John'],
            'date' => 1435350662,
            'forward_from' => ['id' => 1245125, 'first_name' => 'John'],
            'forward_date' => 1435350663,
            'reply_to_message' => ['message_id' => 100, 'from' => ['id' => 1245124, 'first_name' => 'John']],
            'text' => 'message text',
            'audio' => ['file_id' => 'AwADAgADAgAD3xCtBRZ1GtpgRnK5Ag', 'duration' => 1, 'mime_type' => 'audio/mpeg', 'file_size' => 15516232],
            'document' => ['file_id' => 'BQADAgADAwAD3xCtBYugqHR82MqwAg', 'thumb' => [], 'file_name' => 'test.txt', 'file_size' => 38],
            'photo' => []
        ]);
    }
    
    public function testMessageId()
    {
        $this->assertAttributeEquals(123, 'message_id', $this->message);
    }
    
    public function testFrom()
    {
        $this->assertInstanceOf(User::class, $this->message->from);
    }
    
    public function testDate()
    {
        $this->assertAttributeEquals(1435350662, 'date', $this->message);
    }
    
    public function testChatUser()
    {
        $this->message->chat = new User(['id' => 1245125, 'first_name' => 'John']);
        $this->assertInstanceOf(User::class, $this->message->chat);
    }
    
    public function testChatGroupChat()
    {
        $this->message->chat = new GroupChat(['id' => 1245126, 'title' => 'Test group']);
        $this->assertInstanceOf(GroupChat::class, $this->message->chat);
    }
    
    public function testForwardFrom()
    {
        $this->assertInstanceOf(User::class, $this->message->forward_from);
    }
    
    public function testForwardDate()
    {
        $this->assertAttributeEquals(1435350663, 'forward_date', $this->message);
    }
    
    public function testReplyToMessage()
    {
        $this->assertInstanceOf(Message::class, $this->message->reply_to_message);
    }
    
    public function testText()
    {
        $this->assertAttributeEquals('message text', 'text', $this->message);
    }
    
    public function testAudio()
    {
        $this->assertInstanceOf(Audio::class, $this->message->audio);
    }
    
    public function testDocument()
    {
        $this->assertInstanceOf(Document::class, $this->message->document);
    }
    
    public function testPhoto()
    {
        $this->assertAttributeEmpty('photo', $this->message);
    }
}
