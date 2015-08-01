<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\Video;
use Pathetic\TgBot\Types\PhotoSize;

class VideoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Video
     */
    protected $video;
    
    public function setUp()
    {
        $this->video = new Video([
            'file_id' => 'BQADAgADAwAD3xCtBYugqH4D2MqwAg',
            'width' => 960,
            'height' => 720,
            'duration' => 1,
            'thumb' => [],
            'mime_type' => 'video/mp4',
            'file_size' => 38
        ]);
    }
    
    public function testFileId()
    {
        $this->assertAttributeEquals('BQADAgADAwAD3xCtBYugqH4D2MqwAg', 'file_id', $this->video);
    }
    
    public function testWidth()
    {
        $this->assertAttributeEquals(960, 'width', $this->video);
    }
    
    public function testHeight()
    {
        $this->assertAttributeEquals(720, 'height', $this->video);
    }
    
    public function testDuration()
    {
        $this->assertAttributeEquals(1, 'duration', $this->video);
    }
    
    public function testThumb()
    {
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $this->video);
    }
    
    public function testMimeType()
    {
        $this->assertAttributeEquals('video/mp4', 'mime_type', $this->video);
    }
    
    public function testFileSize()
    {
        $this->assertAttributeEquals(38, 'file_size', $this->video);
    }
}
