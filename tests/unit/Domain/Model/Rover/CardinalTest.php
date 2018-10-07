<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Cardinal;
use RoverControlPanel\Domain\Model\Rover\Movement;

class CardinalTest extends TestCase
{

    private const NORTH = 'N';
    private const SOUTH = 'S';
    private const EAST = 'E';
    private const WEST = 'W';
    private const LEFT = 'L';
    private const RIGHT = 'R';
    private const FORWARD = 'M';
    private const VALID_VALUES = [
        [
            self::NORTH,
            self::SOUTH,
            self::EAST,
            self::WEST
        ]
    ];
    private const NORTH_MOVEMENTS = [
        [self::LEFT, self::EAST],
        [self::RIGHT, self::WEST],
        [self::FORWARD, self::NORTH]
    ];
    private const SOUTH_MOVEMENTS = [
        [self::LEFT, self::WEST],
        [self::RIGHT, self::EAST],
        [self::FORWARD, self::SOUTH]
    ];
    private const EAST_MOVEMENTS = [
        [self::LEFT, self::SOUTH],
        [self::RIGHT, self::NORTH],
        [self::FORWARD, self::EAST]
    ];
    private const WEST_MOVEMENTS = [
        [self::LEFT, self::NORTH],
        [self::RIGHT, self::SOUTH],
        [self::FORWARD, self::WEST]
    ];

    public function testCardinalValueShouldBeValid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $notValidValue = true;
        new Cardinal($notValidValue);
    }

    /**
     * @dataProvider getValidValues
     * @param string $value
     */
    public function testValidCardinalShouldReturnTheValue(string $value)
    {
        $cardinal = new Cardinal($value);
        $this->assertEquals(
            $cardinal->value(),
            $value
        );
    }

    /**
     * @dataProvider getNorthMovementValues
     * @param string $movement
     * @param string $value
     */
    public function testMoveNorthCardinalShouldReturnTheNextCardinalValue(string $movement, string $value)
    {
        $movement = new Movement($movement);
        $cardinal = new Cardinal(self::NORTH);
        $newCardinal = $cardinal->move($movement);
        $this->assertEquals(
            $value,
            $newCardinal->value()
        );
    }

    /**
     * @dataProvider getSouthMovementValues
     * @param string $movement
     * @param string $value
     */
    public function testMoveSouthCardinalShouldReturnTheNextCardinalValue(string $movement, string $value)
    {
        $movement = new Movement($movement);
        $cardinal = new Cardinal(self::SOUTH);
        $newCardinal = $cardinal->move($movement);
        $this->assertEquals(
            $value,
            $newCardinal->value()
        );
    }

    /**
     * @dataProvider getEastMovementValues
     * @param string $movement
     * @param string $value
     */
    public function testMoveEastCardinalShouldReturnTheNextCardinalValue(string $movement, string $value)
    {
        $movement = new Movement($movement);
        $cardinal = new Cardinal(self::EAST);
        $newCardinal = $cardinal->move($movement);
        $this->assertEquals(
            $value,
            $newCardinal->value()
        );
    }

    /**
     * @dataProvider getWestMovementValues
     * @param string $movement
     * @param string $value
     */
    public function testMoveWestCardinalShouldReturnTheNextCardinalValue(string $movement, string $value)
    {
        $movement = new Movement($movement);
        $cardinal = new Cardinal(self::WEST);
        $newCardinal = $cardinal->move($movement);
        $this->assertEquals(
            $value,
            $newCardinal->value()
        );
    }

    public function getValidValues(): array
    {
        return self::VALID_VALUES;
    }

    public function getNorthMovementValues(): array
    {
        return self::NORTH_MOVEMENTS;
    }

    public function getSouthMovementValues(): array
    {
        return self::SOUTH_MOVEMENTS;
    }

    public function getEastMovementValues(): array
    {
        return self::EAST_MOVEMENTS;
    }

    public function getWestMovementValues(): array
    {
        return self::WEST_MOVEMENTS;
    }
}
