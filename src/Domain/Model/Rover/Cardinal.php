<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Cardinal
{
    const NORTH = 'N';
    const SOUTH = 'S';
    const EAST = 'E';
    const WEST = 'W';
    private const ALLOWED_VALUES = [
        self::NORTH,
        self::SOUTH,
        self::EAST,
        self::WEST
    ];

    private const NEXT_CARDINAL = [
        self::NORTH => [
            Movement::LEFT => self::WEST,
            Movement::RIGHT => self::EAST,
            Movement::FORWARD => self::NORTH
        ],
        self::SOUTH => [
            Movement::LEFT => self::EAST,
            Movement::RIGHT => self::WEST,
            Movement::FORWARD => self::SOUTH
        ],
        self::EAST => [
            Movement::LEFT => self::NORTH,
            Movement::RIGHT => self::SOUTH,
            Movement::FORWARD => self::EAST
        ],
        self::WEST => [
            Movement::LEFT => self::SOUTH,
            Movement::RIGHT => self::NORTH,
            Movement::FORWARD => self::WEST
        ]
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

    public function value(): string
    {
        return $this->value;
    }

    public function move(Movement $movement): self
    {
        $nextValue = self::NEXT_CARDINAL[$this->value][$movement->value()];

        return new self($nextValue);
    }
}
