<?php

namespace Pathetic\TgBot\Tests\Types;

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
            'from' => [],
            'date' => 1435350662,
            'forward_from' => [],
            'forward_date' => 1435350663,
            'reply_to_message' => [],
            'text' => 'message text',
            'audio' => [],
            'document' => [],
            'photo' => [],
            'sticker' => [],
            'video' => [],
            'contact' => [],
            'location' => [],
            'new_chat_participant' => [],
            'left_chat_participant' => [],
            'new_chat_title' => 'test',
            'new_chat_photo' => [[], [], [], []],
            'delete_chat_photo' => true,
            'group_chat_created' => true
        ]);
    }
    
    public function testMessageId()
    {
        $this->assertAttributeEquals(123, 'message_id', $this->message);
    }
    
    public function testFrom()
    {
        $this->assertAttributeInstanceOf(User::class, 'from', $this->message);
    }
    
    public function testDate()
    {
        $this->assertAttributeEquals(1435350662, 'date', $this->message);
    }
    
    public function testChatUser()
    {
        $this->message->chat = new User(['id' => 1245125, 'first_name' => 'John']);
        $this->assertAttributeInstanceOf(User::class, 'chat', $this->message);
    }
    
    public function testChatGroupChat()
    {
        $this->message->chat = new GroupChat(['id' => 1245126, 'title' => 'Test group']);
        $this->assertAttributeInstanceOf(GroupChat::class, 'chat', $this->message);
    }
    
    public function testForwardFrom()
    {
        $this->assertAttributeInstanceOf(User::class, 'forward_from', $this->message);
    }
    
    public function testForwardDate()
    {
        $this->assertAttributeEquals(1435350663, 'forward_date', $this->message);
    }
    
    public function testReplyToMessage()
    {
        $this->assertAttributeInstanceOf(Message::class, 'reply_to_message', $this->message);
    }
    
    public function testText()
    {
        $this->assertAttributeEquals('message text', 'text', $this->message);
    }
    
    public function testAudio()
    {
        $this->assertAttributeInstanceOf(Audio::class, 'audio', $this->message);
    }
    
    public function testDocument()
    {
        $this->assertAttributeInstanceOf(Document::class, 'document', $this->message);
    }
    
    public function testPhoto()
    {
        $this->assertAttributeEmpty('photo', $this->message);
    }
    
    public function testSticker()
    {
        $this->assertAttributeInstanceOf(Sticker::class, 'sticker', $this->message);
    }
    
    public function testVideo()
    {
        $this->assertAttributeInstanceOf(Video::class, 'video', $this->message);
    }
    
    public function testContact()
    {
        $this->assertAttributeInstanceOf(Contact::class, 'contact', $this->message);
    }
    
    public function testLocation()
    {
        $this->assertAttributeInstanceOf(Location::class, 'location', $this->message);
    }
    
    public function testNewChatParticipant()
    {
        $this->assertAttributeInstanceOf(User::class, 'new_chat_participant', $this->message);
    }
    
    public function testNewChatTitle()
    {
        $this->assertAttributeEquals('test', 'new_chat_title', $this->message);
    }
    
    public function testNewChatPhoto()
    {
        $this->assertAttributeNotEmpty('new_chat_photo', $this->message);
    }
    
    public function testDeleteChatPhoto()
    {
        $this->assertAttributeEquals(true, 'delete_chat_photo', $this->message);
    }
    
    public function testGroupChatCreated()
    {
        $this->assertAttributeEquals(true, 'group_chat_created', $this->message);
    }
}
