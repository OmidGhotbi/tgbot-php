<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\PhotoSize;

class PhotoSizeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\PhotoSize
     */
    protected $photoSize;
    
    public function setUp()
    {
        $this->photoSize = new PhotoSize(['file_id'=> 'BQADAgADAwADBcfqwugqHR82MqwAg', 'width' => 1920, 'height' => 1080, 'file_size' => 124141]);
    }
    
    public function testFileId()
    {
        $this->assertAttributeEquals('BQADAgADAwADBcfqwugqHR82MqwAg', 'file_id', $this->photoSize);
    }
    
    public function testWidth()
    {
        $this->assertAttributeEquals(1920, 'width', $this->photoSize);
    }
    
    public function testHeight()
    {
        $this->assertAttributeEquals(1080, 'height', $this->photoSize);
    }
    
    public function testFileSize()
    {
        $this->assertAttributeEquals(124141, 'file_size', $this->photoSize);
    }
}
