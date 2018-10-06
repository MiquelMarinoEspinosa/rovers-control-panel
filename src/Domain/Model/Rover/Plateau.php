<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Plateau
{
    private const ORIGIN = 0;

    public static function create($topRightAbscissa, $topRightOrdinate): self
    {
        //if (!is_int($topRightAbscissa)) {

        //}

        //if (!is_int($topRightOrdinate)) {

        //}

        if (0 >= $topRightAbscissa || 0 >= $topRightOrdinate) {
            throw new \InvalidArgumentException(
                'Top Right Coordinates have to be greater than Bottom Left Coordinates.' . PHP_EOL
                . "Given Bottom Right Coordinates: 0 0" . PHP_EOL
                . "Given Top Left Coordinates: "
            );
        }

        if ($topRightAbscissa !== $topRightOrdinate) {
            throw new \InvalidArgumentException(
                'Top Right coordinates have to be euql.' . PHP_EOL
                . "Given Bottom Right Coordinates: "
            );
        }

        return new self();
    }

    public function bottomLeftAbscissa(): int
    {
        return self::ORIGIN;
    }
}