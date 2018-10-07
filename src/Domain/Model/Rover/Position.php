<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Position
{
    /** @var Coordinates */
    private $coordinates;
    /** @var Cardinal */
    private $cardinal;

    private function __construct(Coordinates $coordinates, Cardinal $cardinal)
    {
        $this->coordinates = $coordinates;
        $this->cardinal = $cardinal;
    }

    public static function build($abscissa, $ordinate, $cardinal): self
    {
        try {
            $coordinates = new Coordinates($abscissa, $ordinate);
            $cardinal = new Cardinal($cardinal);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $message = 'POSITION creation error: ' . $invalidArgumentException->getMessage();
            throw new \InvalidArgumentException($message);
        }

        return new self($coordinates, $cardinal);
    }

    public function abscissa(): int
    {
        return $this->coordinates->abscissa();
    }

    public function ordinate(): int
    {
        return $this->coordinates->ordinate();
    }

    public function cardinal(): string
    {
        return $this->cardinal->value();
    }
}
