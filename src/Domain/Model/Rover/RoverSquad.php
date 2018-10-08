<?php

namespace RoverControlPanel\Domain\Model\Rover;

class RoverSquad
{
    public static function build(): self
    {
        return new self();
    }

    public function isEmpty(): bool
    {
        return true;
    }
}
