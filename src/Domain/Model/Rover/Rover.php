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
            $plateu = Plateau::build($topRightAbscissa, $topRightOrdinate);
            $position = Position::build($positionAbscissa, $positionOrdinate, $positionCardinal);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $message = $invalidArgumentException->getMessage();
            throw new \InvalidArgumentException('ROVER creation error: ' . $message);
        }

        return new self($plateu, $position);
    }

    private function setPosition(Position $position)
    {
        if ($position->abscissa() > $this->plateau->topRightAbscissa()) {
            throw new \InvalidArgumentException(
                'ROVER creation error: abscissa position greater than plateau top right abscissa.' . PHP_EOL
                . 'Plateau top right abscissa: ' . $this->plateau->topRightAbscissa() . PHP_EOL
                . 'Rover position abscissa: ' . $position->abscissa()
            );
        }

        if ($position->ordinate() > $this->plateau->topRightOrdinate()) {
            throw new \InvalidArgumentException(
                'ROVER creation error: ordinate position greater than plateau top right ordinate.' . PHP_EOL
                . 'Plateau top right ordinate: ' . $this->plateau->topRightOrdinate() . PHP_EOL
                . 'Rover position ordinate: ' . $position->ordinate()
            );
        }

        $this->position = $position;
    }
}
