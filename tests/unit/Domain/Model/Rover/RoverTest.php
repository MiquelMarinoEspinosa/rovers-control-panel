<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Movement;
use RoverControlPanel\Domain\Model\Rover\MoveRoverError;
use RoverControlPanel\Domain\Model\Rover\PositionOutOfTheMap;
use RoverControlPanel\Domain\Model\Rover\Rover;

class RoverTest extends TestCase
{
    private const NORTH = 'N';
    private const EAST = 'E';
    private const WEST = 'W';
    private const SOUTH = 'S';
    private const FORWARD = 'M';

    public function testInvalidPlateauShouldThrowAnException()
    {
        $topRightAbscissa = 0;
        $topRightOrdinate = 1;
        $positionAbscissa = 2;
        $positionOrdinate = 2;
        $positionCardinal = self::NORTH;

        try {
            Rover::build(
                $topRightAbscissa,
                $topRightOrdinate,
                $positionAbscissa,
                $positionOrdinate,
                $positionCardinal
            );
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'rover')
            );
        }
    }

    public function testInvalidPositionShouldThrowAnException()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = -1;
        $positionOrdinate = 2;
        $positionCardinal = self::NORTH;

        try {
            Rover::build(
                $topRightAbscissa,
                $topRightOrdinate,
                $positionAbscissa,
                $positionOrdinate,
                $positionCardinal
            );
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'rover')
            );
        }
    }

    public function testAbscissaGreaterTopRightShouldThrownAnException()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 3;
        $positionOrdinate = 2;
        $positionCardinal = self::NORTH;

        try {
            Rover::build(
                $topRightAbscissa,
                $topRightOrdinate,
                $positionAbscissa,
                $positionOrdinate,
                $positionCardinal
            );
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'rover')
            );
        }
    }

    public function testOrdinateGreaterTopRightShouldThrownAnException()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 2;
        $positionOrdinate = 3;
        $positionCardinal = self::NORTH;

        try {
            Rover::build(
                $topRightAbscissa,
                $topRightOrdinate,
                $positionAbscissa,
                $positionOrdinate,
                $positionCardinal
            );
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'rover')
            );
        }
    }

    public function testMoveAbscissaRoverOutOfBottomLeftPlateauShouldReturnAnException()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 0;
        $positionOrdinate = 0;
        $positionCardinal = self::EAST;

        $rover = Rover::build(
            $topRightAbscissa,
            $topRightOrdinate,
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        );

        $movement = new Movement(self::FORWARD);

        try {
            $rover->move($movement);
        } catch (MoveRoverError $moveRoverError) {
            $this->assertNotFalse(
                strpos(strtolower($moveRoverError->getMessage()), 'rover')
            );
        }
    }

    public function testMoveOrdinateRoverOutOfBottomLeftPlateauShouldReturnAnException()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 0;
        $positionOrdinate = 0;
        $positionCardinal = self::SOUTH;

        $rover = Rover::build(
            $topRightAbscissa,
            $topRightOrdinate,
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        );

        $movement = new Movement(self::FORWARD);

        try {
            $rover->move($movement);
        } catch (MoveRoverError $moveRoverError) {
            $this->assertNotFalse(
                strpos(strtolower($moveRoverError->getMessage()), 'rover')
            );
        }
    }

    public function testMoveAbscissaRoverOutOfTopRightPlateauShouldReturnAnException()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 2;
        $positionOrdinate = 2;
        $positionCardinal = self::WEST;

        $rover = Rover::build(
            $topRightAbscissa,
            $topRightOrdinate,
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        );

        $movement = new Movement(self::FORWARD);

        try {
            $rover->move($movement);
        } catch (MoveRoverError $moveRoverError) {
            $this->assertNotFalse(
                strpos(strtolower($moveRoverError->getMessage()), 'rover')
            );
        }
    }

    public function testMoveOrdinateRoverOutOfTopRightPlateauShouldReturnAnException()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 2;
        $positionOrdinate = 2;
        $positionCardinal = self::NORTH;

        $rover = Rover::build(
            $topRightAbscissa,
            $topRightOrdinate,
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        );

        $movement = new Movement(self::FORWARD);

        try {
            $rover->move($movement);
        } catch (MoveRoverError $moveRoverError) {
            $this->assertNotFalse(
                strpos(strtolower($moveRoverError->getMessage()), 'rover')
            );
        }
    }

    public function testMoveTheRovert()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 1;
        $positionOrdinate = 1;
        $positionCardinal = self::NORTH;

        $rover = Rover::build(
            $topRightAbscissa,
            $topRightOrdinate,
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        );

        $movement = new Movement(self::FORWARD);
        $roverMoved = $rover->move($movement);

        $this->assertEquals(
            $positionAbscissa,
            $roverMoved->abscissa()
        );

        $this->assertEquals(
            $positionOrdinate + 1,
            $roverMoved->ordinate()
        );

        $this->assertEquals(
            $positionCardinal,
            $roverMoved->cardinal()
        );
    }
}
