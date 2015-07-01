<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\Contact;

class ContactTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Contact
     */
    protected $contact;
    
    public function setUp()
    {
        $this->contact = new Contact(['phone_number' => '+12025550157', 'first_name' => 'John', 'last_name' => 'Doe', 'user_id' => 87248523]);
    }
    
    public function testPhoneNumber()
    {
        $this->assertAttributeEquals('+12025550157', 'phone_number', $this->contact);
    }
    
    public function testFirstName()
    {
        $this->assertAttributeEquals('John', 'first_name', $this->contact);
    }
    
    public function testLastName()
    {
        $this->assertAttributeEquals('Doe', 'last_name', $this->contact);
    }
    
    public function testUserId()
    {
        $this->assertAttributeEquals(87248523, 'user_id', $this->contact);
    }
}
