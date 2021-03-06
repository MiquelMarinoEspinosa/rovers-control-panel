<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Movement;

class MovementTest extends TestCase
{
    private const LEFT = 'L';
    private const RIGHT = 'R';
    private const FORWARD = 'M';
    private const VALID_VALUES = [
        [
            self::LEFT,
            self::RIGHT,
            self::FORWARD
        ]
    ];

    public function testValueShouldBeValid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $value = 1;
        new Movement($value);
    }

    /**
     * @dataProvider getValidValues
     * @param string $value
     */
    public function testShouldReturnTheValue(string $value)
    {
        $movement = new Movement($value);
        $this->assertEquals(
            $value,
            $movement->value()
        );
    }

    public function testIsForwardMovement()
    {
        $this->assertTrue(
            (new Movement(self::FORWARD))->isForward()
        );
    }

    public function testIsNotForwardMovement()
    {
        $this->assertFalse(
            (new Movement(self::LEFT))->isForward()
        );
    }

    public function getValidValues(): array
    {
        return self::VALID_VALUES;
    }
}
