<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\InstructionCollection;
use RoverControlPanel\Domain\Model\Rover\Rover;
use RoverControlPanel\Domain\Model\Rover\RoverSquad;

class RoverSquadTest extends TestCase
{
    private const NORTH = 'N';
    private const EAST = 'E';
    private const WEST = 'W';

    public function testShouldCreateAnEmptySquad()
    {
        $this->assertTrue(
            (RoverSquad::build([], []))->isEmpty()
        );
    }

    public function testShouldCreateNotEmptySquad()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 1;
        $positionOrdinate = 1;
        $positionCardinal = self::NORTH;

        $plateau = [$topRightAbscissa, $topRightOrdinate];
        $position = [
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        ];
        $positions = [$position];

        $this->assertFalse(
            (RoverSquad::build($plateau, $positions))->isEmpty()
        );
    }

    public function testShouldReturnTheCurrentRover()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 1;
        $positionOrdinate = 1;
        $positionCardinal = self::NORTH;

        $plateau = [$topRightAbscissa, $topRightOrdinate];
        $position = [
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        ];
        $positions = [$position];

        $rover = Rover::build(
            $topRightAbscissa,
            $topRightOrdinate,
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        );


        $roverSquad = RoverSquad::build($plateau, $positions);

        $this->assertEquals(
            $rover,
            $roverSquad->current()
        );
    }

    public function testShouldReturnTheNextRover()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 1;
        $positionOrdinate = 1;
        $positionCardinal = self::NORTH;

        $plateau = [$topRightAbscissa, $topRightOrdinate];
        $position = [
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        ];


        $anotherPositionAbscissa = 0;
        $anotherPositionOrdinate = 0;
        $anotherPositionCardinal = self::EAST;
        $anotherPosition = [
            $anotherPositionAbscissa,
            $anotherPositionOrdinate,
            $anotherPositionCardinal
        ];

        $positions = [$position, $anotherPosition];

        $nextRover = Rover::build(
            $topRightAbscissa,
            $topRightOrdinate,
            $anotherPositionAbscissa,
            $anotherPositionOrdinate,
            $anotherPositionCardinal
        );


        $roverSquad = RoverSquad::build($plateau, $positions);
        $roverSquad->next();

        $this->assertEquals(
            $nextRover,
            $roverSquad->current()
        );
    }

    public function testShouldTheRoversExploreThePlateau()
    {
        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 1;
        $positionOrdinate = 1;
        $positionCardinal = self::NORTH;

        $plateau = [$topRightAbscissa, $topRightOrdinate];
        $position = [
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        ];


        $anotherPositionAbscissa = 0;
        $anotherPositionOrdinate = 0;
        $anotherPositionCardinal = self::EAST;
        $anotherPosition = [
            $anotherPositionAbscissa,
            $anotherPositionOrdinate,
            $anotherPositionCardinal
        ];

        $positions = [$position, $anotherPosition];

        $roverSquad = RoverSquad::build($plateau, $positions);


        $instructionAsArray = [['L','R','M'], ['R', 'M', 'R', 'M']];
        $instructionCollection = InstructionCollection::build($instructionAsArray);

        $topRightAbscissa = 2;
        $topRightOrdinate = 2;
        $positionAbscissa = 1;
        $positionOrdinate = 2;
        $positionCardinal = self::NORTH;

        $plateau = [$topRightAbscissa, $topRightOrdinate];
        $position = [
            $positionAbscissa,
            $positionOrdinate,
            $positionCardinal
        ];


        $anotherPositionAbscissa = 1;
        $anotherPositionOrdinate = 1;
        $anotherPositionCardinal = self::WEST;
        $anotherPosition = [
            $anotherPositionAbscissa,
            $anotherPositionOrdinate,
            $anotherPositionCardinal
        ];

        $positions = [$position, $anotherPosition];
        $roverSquadExplored = RoverSquad::build($plateau, $positions);

        $this->assertEquals(
            $roverSquadExplored,
            $roverSquad->explore($instructionCollection)
        );
    }
}
