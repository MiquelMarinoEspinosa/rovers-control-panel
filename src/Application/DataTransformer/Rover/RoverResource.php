<?php

namespace RoverControlPanel\Application\DataTransformer\Rover;

class RoverResource
{
    /** @var int */
    private $abscissa;
    /** @var int */
    private $ordinate;
    /** @var string */
    private $cardinal;

    public function __construct(
        int $abscissa,
        int $ordinate,
        string $cardinal
    ) {
        $this->abscissa = $abscissa;
        $this->ordinate = $ordinate;
        $this->cardinal = $cardinal;
    }

    public function getAbscissa(): int
    {
        return $this->abscissa;
    }

    public function getOrdinate(): int
    {
        return $this->ordinate;
    }

    public function getCardinal(): string
    {
        return $this->cardinal;
    }
}
