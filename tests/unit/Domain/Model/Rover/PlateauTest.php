<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Plateau;

class PlateauTest extends TestCase
{
    private const BOTTOM_LEFT_ABSCISSA = 0;
    private const BOTTOM_LEFT_ORDINATE = 0;

    public function testTheCoordinatesHaveToBeValid()
    {
        $topRightAbscissa = 0;
        $topRightOrdinate = -1;
        try {
            Plateau::create($topRightAbscissa, $topRightOrdinate);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'plateau')
            );
        }
    }

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

    public function testValidPlateauHasToReturnTheBottomLeftOrdinateValue()
    {
        $topRightAbscissa = 5;
        $topRightOrdinate = 5;
        $plateau = Plateau::create($topRightAbscissa, $topRightOrdinate);
        $this->assertSame(
            self::BOTTOM_LEFT_ORDINATE,
            $plateau->bottomLeftOrdinate()
        );
    }

    public function testValidPlateauHasToReturnTheTopRightAbscissaValue()
    {
        $topRightAbscissa = 5;
        $topRightOrdinate = 5;
        $plateau = Plateau::create($topRightAbscissa, $topRightOrdinate);
        $this->assertSame(
            $topRightAbscissa,
            $plateau->topRightAbscissa()
        );
    }

    public function testValidPlateauHasToReturnTheTopRightOrdinateValue()
    {
        $topRightAbscissa = 5;
        $topRightOrdinate = 5;
        $plateau = Plateau::create($topRightAbscissa, $topRightOrdinate);
        $this->assertSame(
            $topRightOrdinate,
            $plateau->topRightOrdinate()
        );
    }
}
