<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\Sticker;
use Pathetic\TgBot\Types\PhotoSize;

class StickerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Sticker
     */
    protected $sticker;
    
    public function setUp()
    {
        $this->sticker = new Sticker(['file_id' => 'BQFQWADAwAD3xCtBYugqHR82MqwAg', 'width' => 360, 'height' => 240, 'thumb' => [], 'file_size' => 41234]);
    }
    
    public function testFileId()
    {
        $this->assertAttributeEquals('BQFQWADAwAD3xCtBYugqHR82MqwAg', 'file_id', $this->sticker);
    }
    
    public function testWidth()
    {
        $this->assertAttributeEquals(360, 'width', $this->sticker);
    }
    
    public function testHeight()
    {
        $this->assertAttributeEquals(240, 'height', $this->sticker);
    }
    
    public function testThumb()
    {
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $this->sticker);
    }
    
    public function testFileSize()
    {
        $this->assertAttributeEquals(41234, 'file_size', $this->sticker);
    }
}
