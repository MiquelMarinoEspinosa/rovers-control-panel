<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Cardinal;

class CardinalTest extends TestCase
{
    private const VALID_VALUES = [Cardinal::ALLOWED_VALUES];

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
            $cardinal->getValue(),
            $value
        );
    }

    public function getValidValues(): array
    {
        return self::VALID_VALUES;
    }
}
