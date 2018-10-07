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

    public function move(Movement $movement): self
    {
        $newCardinal = $this->cardinal->move($movement);
        if (!$movement->isForward()) {
            return new self($this->coordinates, $newCardinal);
        }
        $newCoordinates = $this->moveCoordinatesForward();

        return new self($newCoordinates, $newCardinal);
    }

    private function moveCoordinatesForward(): Coordinates
    {
        switch ($this->cardinal->value()) {
            case Cardinal::NORTH:
                return $this->coordinates->incrementOrdinate();
            case Cardinal::SOUTH:
                try {
                    return $this->coordinates->decrementOrdinate();
                } catch (\InvalidArgumentException $invalidArgumentException) {
                    $message = $invalidArgumentException->getMessage();
                    throw new PositionOutOfTheMap(
                        'POSITION move error decrement ordinate south cardinal: ' . $message
                    );
                }
            case Cardinal::WEST:
                return $this->coordinates->incrementAbscissa();
            //EAST
            default:
                try {
                    return $this->coordinates->decrementAbscissa();
                } catch (\InvalidArgumentException $invalidArgumentException) {
                    $message = $invalidArgumentException->getMessage();
                    throw new PositionOutOfTheMap(
                        'POSITION move error decrement abscissa east cardinal: ' . $message
                    );
                }
        }
    }
}
