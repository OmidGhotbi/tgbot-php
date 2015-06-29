<?php

namespace Pathetic\TgBot\Tests;

use Pathetic\TgBot\Types\Audio;

class AudioTest extends \PHPUnit_Framework_TestCase
{
    protected $audio;
    
    public function setUp()
    {
        $this->audio = new Audio(['file_id' => 1]);
    }
    
    public function testFileId()
    {
        $this->assertAttributeEquals(1, 'file_id', $this->audio);
    }
}
