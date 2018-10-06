<?php

namespace RoverControlPanel\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Coordinates;

class CoordinatesTest extends TestCase
{
    public function testAbscissaShouldBeEqualOrGreaterZero()
    {
        $this->expectException(\InvalidArgumentException::class);
        $abscissa = -1;
        $ordinate = 0;
        new Coordinates($abscissa, $ordinate);
    }

    public function testOrdinateShouldBeEqualOrGreaterZero()
    {
        $this->expectException(\InvalidArgumentException::class);
        $abscissa = 0;
        $ordinate = -1;
        new Coordinates($abscissa, $ordinate);
    }

    public function testValidCoordinatesShouldReturnTheAbscissaValue()
    {
        $abscissa = 1;
        $ordinate = 0;
        $coordinates = new Coordinates($abscissa, $ordinate);
        $this->assertSame(
            $abscissa,
            $coordinates->abscissa()
        );
    }

    public function testValidCoordinatesShouldReturnTheOrdinateValue()
    {
        $abscissa = 0;
        $ordinate = 1;
        $coordinates = new Coordinates($abscissa, $ordinate);
        $this->assertSame(
            $ordinate,
            $coordinates->ordinate()
        );
    }
}
