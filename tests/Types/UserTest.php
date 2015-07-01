<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\User
     */
    protected $user;
    
    public function setUp()
    {
        $this->user = new User(['id' => 87248523, 'first_name' => 'John', 'last_name' => 'Doe', 'username' => 'JohnDoe']);
    }
    
    public function testId()
    {
        $this->assertAttributeEquals(87248523, 'id', $this->user);
    }
    
    public function testFirstName()
    {
        $this->assertAttributeEquals('John', 'first_name', $this->user);
    }
    
    public function testLastName()
    {
        $this->assertAttributeEquals('Doe', 'last_name', $this->user);
    }
    
    public function testUsername()
    {
        $this->assertAttributeEquals('JohnDoe', 'username', $this->user);
    }
}
