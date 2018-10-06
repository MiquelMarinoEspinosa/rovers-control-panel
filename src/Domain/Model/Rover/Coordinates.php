<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Coordinates
{
    const MIN_VALUE = 0;
    const ORDINATE = 'ordinate';
    const ABSCISSA = 'abscissa';

    /** @var int */
    private $abscissa;
    /** @var int */
    private $ordinate;

    public function __construct(int $abscissa, int $ordinate)
    {
        $this->setAbscissa($abscissa);
        $this->setOrdinate($ordinate);
    }

    private function setAbscissa(int $abscissa): void
    {
        $this->validate(self::ABSCISSA, $abscissa);
        $this->abscissa = $abscissa;
    }

    private function setOrdinate(int $ordinate): void
    {
        $this->validate(self::ORDINATE, $ordinate);
        $this->ordinate = $ordinate;
    }

    private function validate(string $name, int $value): void
    {
        if (self::MIN_VALUE > $value) {
            throw new \InvalidArgumentException(
                "The $name has to be a number greater or equal 0. Given: $value"
            );
        }
    }

    public function getAbscissa(): int
    {
        return $this->abscissa;
    }

    public function getOrdinate(): int
    {
        return $this->ordinate;
    }
}