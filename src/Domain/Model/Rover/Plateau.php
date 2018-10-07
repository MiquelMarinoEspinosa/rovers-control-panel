<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Plateau
{
    private const ORIGIN = 0;

    /** @var Coordinates */
    private $topRight;

    private function __construct(Coordinates $topRight)
    {
        $this->setTopRight($topRight);
    }

    public static function create($topRightAbscissa, $topRightOrdinate): self
    {

        try {
            $coordinates = new Coordinates($topRightAbscissa, $topRightOrdinate);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $message = 'PLATEAU creation error: ' . $invalidArgumentException->getMessage();
            throw new \InvalidArgumentException($message);
        }

        return new self($coordinates);
    }

    private function setTopRight(Coordinates $topRight)
    {
        $abscissa = $topRight->abscissa();
        $ordinate = $topRight->ordinate();
        if ($this->origin() >= $abscissa || $this->origin() >= $ordinate) {
            throw new \InvalidArgumentException(
                'PLATEAU creation error:' . PHP_EOL
                . 'Top Right Coordinates have to be greater than Bottom Left Coordinates.' . PHP_EOL
                . "Given Bottom Right Coordinates: 0 0" . PHP_EOL
                . "Given Top Left Coordinates: $abscissa $ordinate"
            );
        }

        if ($abscissa !== $ordinate) {
            throw new \InvalidArgumentException(
                'PLATEAU creation error:' . PHP_EOL
                . 'Top Right coordinates have to be euql.' . PHP_EOL
                . "Given Bottom Right Coordinates: $abscissa $ordinate"
            );
        }
        $this->topRight = $topRight;
    }

    public function bottomLeftAbscissa(): int
    {
        return $this->origin();
    }

    public function bottomLeftOrdinate(): int
    {
        return $this->origin();
    }

    public function topRightAbscissa(): int
    {
        return $this->topRight->abscissa();
    }

    public function topRightOrdinate(): int
    {
        return $this->topRight->ordinate();
    }

    private function origin(): int
    {
        return self::ORIGIN;
    }
}
