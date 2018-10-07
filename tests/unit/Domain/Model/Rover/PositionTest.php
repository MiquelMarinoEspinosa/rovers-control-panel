<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Position;

class PositionTest extends TestCase
{
    public function testNotValidAbscissaCoordinatesShouldThrowAnExceptionWithMessage()
    {
        $abscissa = -1;
        $ordiante = 0;
        $cardinal = true;
        try {
            Position::build($abscissa, $ordiante, $cardinal);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'position')
            );
        }
    }

    public function testNotValidOrdinateCoordinatesShouldThrowAnExceptionWithMessage()
    {
        $abscissa = 0;
        $ordinate = -1;
        $cardinal = true;
        try {
            Position::build($abscissa, $ordinate, $cardinal);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'position')
            );
        }
    }

    public function testNotValidCardinalCoordinatesShouldThrowAnExceptionWithMessage()
    {
        $abscissa = 0;
        $ordinate = 0;
        $cardinal = true;
        try {
            Position::build($abscissa, $ordinate, $cardinal);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'position')
            );
        }
    }

    public function testValidPositionShouldReturnTheAbscissaValue()
    {
        $abscissa = 3;
        $ordinate = 3;
        $cardinal = 'N';

        $position = Position::build($abscissa, $ordinate, $cardinal);

        $this->assertEquals(
            $abscissa,
            $position->abscissa()
        );
    }

    public function testValidPositionShouldReturnTheOrdinateValue()
    {
        $abscissa = 3;
        $ordinate = 3;
        $cardinal = 'N';

        $position = Position::build($abscissa, $ordinate, $cardinal);

        $this->assertEquals(
            $ordinate,
            $position->ordinate()
        );
    }

    public function testValidPositionShouldReturnTheCardinalValue()
    {
        $abscissa = 3;
        $ordinate = 3;
        $cardinal = 'N';

        $position = Position::build($abscissa, $ordinate, $cardinal);

        $this->assertEquals(
            $cardinal,
            $position->cardinal()
        );
    }
}
