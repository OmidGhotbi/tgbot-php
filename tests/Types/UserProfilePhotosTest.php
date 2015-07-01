<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\UserProfilePhotos;

class UserProfilePhotosTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\UserProfilePhotos
     */
    protected $userProfilePhotos;
    
    public function setUp()
    {
        $this->userProfilePhotos = new UserProfilePhotos(['total_count' => 4, 'photos' => [[], [], [], []]]);
    }
    
    public function testTotalCount()
    {
        $this->assertAttributeEquals(4, 'total_count', $this->userProfilePhotos);
    }
    
    public function testPhotos()
    {
        $this->assertAttributeNotEmpty('photos', $this->userProfilePhotos);
    }
}
