<?php

namespace RoverControlPanel\Application\UseCase\Rover;

class RoverSquadExplorationRequest
{
    /** @var int */
    private $plateauTopRightAbscissa;
    /** @var int */
    private $plateauTopRightOrdinate;
    /** @var array */
    private $positions;
    /** @var array */
    private $instructions;

    public function __construct(
        $plateauTopRightAbscissa,
        $plateauTopRightOrdinate,
        $positions,
        $instructions
    ) {
        $this->plateauTopRightAbscissa = $plateauTopRightAbscissa;
        $this->plateauTopRightOrdinate = $plateauTopRightOrdinate;
        $this->positions = $positions;
        $this->instructions = $instructions;
    }

    public function plateauTopRightAbscissa()
    {
        return $this->plateauTopRightAbscissa;
    }

    public function plateauTopRightOrdinate()
    {
        return $this->plateauTopRightOrdinate;
    }

    public function positions()
    {
        return $this->positions;
    }

    public function instructions()
    {
        return $this->instructions;
    }
}
