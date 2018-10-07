<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Movement;
use RoverControlPanel\Domain\Model\Rover\Position;
use RoverControlPanel\Domain\Model\Rover\PositionOutOfTheMap;

class PositionTest extends TestCase
{
    private const FORWARD = 'M';
    private const LEFT = 'L';
    private const NORTH = 'N';
    private const SOUTH = 'S';
    private const EAST = 'E';
    private const WEST = 'W';

    public function testNotValidAbscissaCoordinatesShouldThrowAnExceptionWithMessage()
    {
        $abscissa = -1;
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
        $cardinal = self::NORTH;

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
        $cardinal = self::NORTH;

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
        $cardinal = self::NORTH;

        $position = Position::build($abscissa, $ordinate, $cardinal);

        $this->assertEquals(
            $cardinal,
            $position->cardinal()
        );
    }

    public function testMoveLeftNorthShouldChangeCardinalToEast()
    {
        $abscissa = 3;
        $ordinate = 3;

        $position = Position::build($abscissa, $ordinate, self::NORTH);
        $movement = new Movement(self::LEFT);
        $newPosition = $position->move($movement);

        $this->assertEquals(
            self::EAST,
            $newPosition->cardinal()
        );

        $this->assertEquals(
            $abscissa,
            $newPosition->abscissa()
        );

        $this->assertEquals(
            $ordinate,
            $newPosition->ordinate()
        );
    }

    public function testMoveForwardNorthShouldIncrementOrdinateCoordinates()
    {
        $abscissa = 3;
        $ordinate = 3;
        $cardinal = self::NORTH;

        $position = Position::build($abscissa, $ordinate, $cardinal);
        $movement = new Movement(self::FORWARD);
        $newPosition = $position->move($movement);

        $this->assertEquals(
            $cardinal,
            $newPosition->cardinal()
        );

        $this->assertEquals(
            $abscissa,
            $newPosition->abscissa()
        );

        $this->assertEquals(
            $ordinate + 1,
            $newPosition->ordinate()
        );
    }

    public function testMoveForwardSouthShouldDecrementOrdinateCoordinates()
    {
        $abscissa = 3;
        $ordinate = 3;
        $cardinal = self::SOUTH;

        $position = Position::build($abscissa, $ordinate, $cardinal);
        $movement = new Movement(self::FORWARD);
        $newPosition = $position->move($movement);

        $this->assertEquals(
            $cardinal,
            $newPosition->cardinal()
        );

        $this->assertEquals(
            $abscissa,
            $newPosition->abscissa()
        );

        $this->assertEquals(
            $ordinate - 1,
            $newPosition->ordinate()
        );
    }

    public function testMoveForwardWestShouldIncrementAbscissaCoordinates()
    {
        $abscissa = 3;
        $ordinate = 3;
        $cardinal = self::WEST;

        $position = Position::build($abscissa, $ordinate, $cardinal);
        $movement = new Movement(self::FORWARD);
        $newPosition = $position->move($movement);

        $this->assertEquals(
            $cardinal,
            $newPosition->cardinal()
        );

        $this->assertEquals(
            $abscissa + 1,
            $newPosition->abscissa()
        );

        $this->assertEquals(
            $ordinate,
            $newPosition->ordinate()
        );
    }

    public function testMoveForwardEastShouldDecrementAbscissaCoordinates()
    {
        $abscissa = 3;
        $ordinate = 3;
        $cardinal = self::EAST;

        $position = Position::build($abscissa, $ordinate, $cardinal);
        $movement = new Movement(self::FORWARD);
        $newPosition = $position->move($movement);

        $this->assertEquals(
            $cardinal,
            $newPosition->cardinal()
        );

        $this->assertEquals(
            $abscissa - 1,
            $newPosition->abscissa()
        );

        $this->assertEquals(
            $ordinate,
            $newPosition->ordinate()
        );
    }

    public function testEastCardinalAndZeroAbscissaMoveForwardShouldThrowAnException()
    {
        $abscissa = 0;
        $ordinate = 3;
        $cardinal = self::EAST;
        $position = Position::build($abscissa, $ordinate, $cardinal);
        $movement = new Movement(self::FORWARD);

        try {
            $position->move($movement);
        } catch (PositionOutOfTheMap $positionOutOfTheMap) {
            $this->assertNotFalse(
                strpos(strtolower($positionOutOfTheMap->getMessage()), 'position')
            );
        }
    }

    public function testSouthCardinalAndZeroOrdinateMoveForwardShouldThrowAnException()
    {
        $abscissa = 3;
        $ordinate = 0;
        $cardinal = self::SOUTH;
        $position = Position::build($abscissa, $ordinate, $cardinal);
        $movement = new Movement(self::FORWARD);

        try {
            $position->move($movement);
        } catch (PositionOutOfTheMap $positionOutOfTheMap) {
            $this->assertNotFalse(
                strpos(strtolower($positionOutOfTheMap->getMessage()), 'position')
            );
        }
    }
}
