<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Rover;

class RoverTest extends TestCase
{
    private const NORTH = 'N';

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
}
