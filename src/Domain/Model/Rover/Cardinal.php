<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Cardinal
{
    private const NORTH = 'N';
    private const SOUTH = 'S';
    private const EAST = 'E';
    private const WEST = 'W';
    private const ALLOWED_VALUES = [
        self::NORTH,
        self::SOUTH,
        self::EAST,
        self::WEST
    ];

    /** @var string $value */
    private $value;

    public function __construct($value)
    {
        $this->setValue($value);
    }

    private function setValue($value)
    {
        if (!in_array($value, self::ALLOWED_VALUES, true)) {
            $validValues = implode(',', self::ALLOWED_VALUES);
            throw new \InvalidArgumentException(
                "Invalid CARDINAL value. Valid Values: $validValues. Given: $value"
            );
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
