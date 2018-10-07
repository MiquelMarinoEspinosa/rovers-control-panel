<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Rover
{
    /** @var Plateau */
    private $plateau;
    /** @var Position */
    private $position;

    private function __construct(Plateau $plateau, Position $position)
    {
        $this->plateau = $plateau;
        $this->setPosition($position);
    }

    public static function build(
        $topRightAbscissa,
        $topRightOrdinate,
        $positionAbscissa,
        $positionOrdinate,
        $positionCardinal
    ): self {
        try {
            $plateau = Plateau::build($topRightAbscissa, $topRightOrdinate);
            $position = Position::build($positionAbscissa, $positionOrdinate, $positionCardinal);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $message = $invalidArgumentException->getMessage();
            throw new \InvalidArgumentException('ROVER error: ' . $message);
        }

        return new self($plateau, $position);
    }

    private function setPosition(Position $position)
    {
        if ($position->abscissa() > $this->plateau->topRightAbscissa()) {
            throw new \InvalidArgumentException(
                'ROVER position error: abscissa position greater than plateau top right abscissa.' . PHP_EOL
                . 'Plateau top right abscissa: ' . $this->plateau->topRightAbscissa() . PHP_EOL
                . 'Rover position abscissa: ' . $position->abscissa()
            );
        }

        if ($position->ordinate() > $this->plateau->topRightOrdinate()) {
            throw new \InvalidArgumentException(
                'ROVER position error: ordinate position greater than plateau top right ordinate.' . PHP_EOL
                . 'Plateau top right ordinate: ' . $this->plateau->topRightOrdinate() . PHP_EOL
                . 'Rover position ordinate: ' . $position->ordinate()
            );
        }

        $this->position = $position;
    }

    public function move(Movement $movement): self
    {
        try {
            $newPosition = $this->position->move($movement);

            return new self($this->plateau, $newPosition);
        } catch (\Exception $exception) {
            throw new MoveRoverError('ROVER move error: ' . $exception->getMessage());
        }
    }

    public function abscissa(): int
    {
        return $this->position->abscissa();
    }

    public function ordinate(): int
    {
        return $this->position->ordinate();
    }

    public function cardinal(): string
    {
        return $this->position->cardinal();
    }
}
