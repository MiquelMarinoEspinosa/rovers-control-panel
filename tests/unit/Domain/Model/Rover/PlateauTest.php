<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Plateau;

class PlateauTest extends TestCase
{
    private const BOTTOM_LEFT_ABSCISSA = 0;

    public function testThanTopRightHasToBeGreaterBottomLeftCoordinates()
    {
        $this->expectException(\InvalidArgumentException::class);
        $topRightAbscissa = 0;
        $topRightOrdinate = 0;
        Plateau::create($topRightAbscissa, $topRightOrdinate);
    }

    public function testTopRightCoordinatesHasToBeEqualsBetweenThem()
    {
        $this->expectException(\InvalidArgumentException::class);
        $topRightAbscissa = 1;
        $topRightOrdinate = 2;
        Plateau::create($topRightAbscissa, $topRightOrdinate);
    }

    public function testValidPlateauHasToReturnTheBottomLeftAbscissaValue()
    {
        $topRightAbscissa = 5;
        $topRightOrdinate = 5;
        $plateau = Plateau::create($topRightAbscissa, $topRightOrdinate);
        $this->assertSame(
            self::BOTTOM_LEFT_ABSCISSA,
            $plateau->bottomLeftAbscissa()
        );
    }
}
