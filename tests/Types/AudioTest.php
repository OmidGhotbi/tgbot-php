<?php

namespace Pathetic\TgBot\Tests;

use Pathetic\TgBot\Types\Audio;

class AudioTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Audio
     */
    protected $audio;
    
    public function setUp()
    {
        $this->audio = new Audio(['file_id' => 'AwADAgADAgAD3xCtBRZ1GtpgRnK5Ag', 'duration' => 1, 'mime_type' => 'audio/mpeg', 'file_size' => 15516232]);
    }
    
    public function testFileId()
    {
        $this->assertAttributeEquals('AwADAgADAgAD3xCtBRZ1GtpgRnK5Ag', 'file_id', $this->audio);
    }
    
    public function testDuration()
    {
        $this->assertAttributeEquals(1, 'duration', $this->audio);
    }
    
    public function testMimeType()
    {
        $this->assertAttributeEquals('audio/mpeg', 'mime_type', $this->audio);
    }
    
    public function testFileSize()
    {
        $this->assertAttributeEquals(15516232, 'file_size', $this->audio);
    }
}
