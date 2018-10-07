<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Movement;

class MovementTest extends TestCase
{
    private const VALID_VALUES = [Movement::ALLOWED_VALUES];

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

    public function getValidValues(): array
    {
        return self::VALID_VALUES;
    }
}
