<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Rover;
use RoverControlPanel\Domain\Model\Rover\RoverSquad;

class RoverSquadTest extends TestCase
{
    private const NORTH = 'N';

    public function testShouldCreateAnEmptySquad()
    {
        $this->assertTrue(
            (RoverSquad::build())->isEmpty()
        );
    }

    public function shouldCreateAnNotEmptySquad()
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
}
