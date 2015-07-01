<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\Document;
use Pathetic\TgBot\Types\PhotoSize;

class DocumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Document
     */
    protected $document;
    
    public function setUp()
    {
        $this->document = new Document(['file_id' => 'BQADAgADAwAD3xCtBYugqHR82MqwAg', 'thumb' => [], 'file_name' => 'test.txt', 'file_size' => 38]);
    }
    
    public function testFileId()
    {
        $this->assertAttributeEquals('BQADAgADAwAD3xCtBYugqHR82MqwAg', 'file_id', $this->document);
    }
    
    public function testThumb()
    {
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $this->document);
    }
    
    public function testFileName()
    {
        $this->assertAttributeEquals('test.txt', 'file_name', $this->document);
    }
    
    public function testFileSize()
    {
        $this->assertAttributeEquals(38, 'file_size', $this->document);
    }
}
