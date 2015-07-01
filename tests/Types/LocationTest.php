<?php

namespace Pathetic\TgBot\Tests\Types;

use Pathetic\TgBot\Types\Location;

class LocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pathetic\TgBot\Types\Location
     */
    protected $location;
    
    public function setUp()
    {
        $this->location = new Location(['latitude' => 41.740104, 'longitude' => -71.560718]);
    }
    
    public function testLatitude()
    {
        $this->assertAttributeEquals(41.740104, 'latitude', $this->location);
    }
    
    public function testLongitude()
    {
        $this->assertAttributeEquals(-71.560718, 'longitude', $this->location);
    }
}
