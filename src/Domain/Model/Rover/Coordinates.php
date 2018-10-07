<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Coordinates
{
    private const MIN_VALUE = 0;
    private const ORDINATE = 'ordinate';
    private const ABSCISSA = 'abscissa';

    /** @var int */
    private $abscissa;
    /** @var int */
    private $ordinate;

    public function __construct($abscissa, $ordinate)
    {
        $this->setAbscissa($abscissa);
        $this->setOrdinate($ordinate);
    }

    private function setAbscissa($abscissa): void
    {
        $this->validate(self::ABSCISSA, $abscissa);
        $this->abscissa = (int) $abscissa;
    }

    private function setOrdinate($ordinate): void
    {
        $this->validate(self::ORDINATE, $ordinate);
        $this->ordinate = (int) $ordinate;
    }

    private function validate(string $name, $value): void
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException(
                "The COORDINATE $name has to be an integer value. Given: $value"
            );
        }

        if (self::MIN_VALUE > (int) $value) {
            throw new \InvalidArgumentException(
                "The COORDINATE $name has to be a number greater or equal 0. Given: $value"
            );
        }
    }

    public function abscissa(): int
    {
        return $this->abscissa;
    }

    public function ordinate(): int
    {
        return $this->ordinate;
    }
}