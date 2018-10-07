<?php

namespace RoverControlPanel\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Coordinates;

class CoordinatesTest extends TestCase
{
    public function testAbscissaShouldBeAnInteger()
    {
        $this->expectException(\InvalidArgumentException::class);
        $abscissa = "A";
        $ordinate = 0;
        new Coordinates($abscissa, $ordinate);
    }

    public function testOrdinateShouldBeEqualAnInteger()
    {
        $this->expectException(\InvalidArgumentException::class);
        $abscissa = 0;
        $ordinate = "B";
        new Coordinates($abscissa, $ordinate);
    }

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

    public function testShouldIncrementTheAbscissaValue()
    {
        $abscissa = 0;
        $ordinate = 1;
        $coordinates = new Coordinates($abscissa, $ordinate);
        $this->assertSame(
            $abscissa + 1,
            $coordinates->incrementAbscissa()->abscissa()
        );
    }

    public function testShouldIncrementTheOrdinateValue()
    {
        $abscissa = 0;
        $ordinate = 1;
        $coordinates = new Coordinates($abscissa, $ordinate);
        $this->assertSame(
            $ordinate + 1,
            $coordinates->incrementOrdinate()->ordinate()
        );
    }
}
