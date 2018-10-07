<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Movement
{
    const LEFT = 'L';
    const RIGHT = 'R';
    const FORWARD = 'M';
    private const ALLOWED_VALUES = [
        self::LEFT,
        self::RIGHT,
        self::FORWARD
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
            throw new \InvalidArgumentException("Invalid MOVEMENT value. Valid Values: $validValues. Given: $value");
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isForward(): bool
    {
        return self::FORWARD === $this->value;
    }
}
