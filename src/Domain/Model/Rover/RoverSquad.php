<?php

namespace RoverControlPanel\Domain\Model\Rover;

class RoverSquad
{
    /** @var Rover[] */
    private $rovers;

    private function __construct(array $rovers)
    {
        $this->rovers = $rovers;
    }

    public static function build(array $plateau, array $positions): self
    {
        $rovers = [];
        foreach ($positions as $position) {
            $rovers[] = Rover::build(
                $plateau[0],
                $plateau[1],
                $position[0],
                $position[1],
                $position[2]
            );
        }

        return new self($rovers);
    }

    public function isEmpty(): bool
    {
        return empty($this->rovers);
    }

    public function current(): Rover
    {
        return current($this->rovers);
    }

    public function next()
    {
        return next($this->rovers);
    }

    public function move(InstructionCollection $instructionCollection): self
    {
        $rovers = [];
        $rover = current($this->rovers);
        do {
            $instruction = $instructionCollection->current();
            $movement = $instruction->current();
            do {
                $rover = $rover->move($movement);
            } while ($movement = $instruction->next());
            $rovers[] = $rover;
            $instructionCollection->next();
        } while ($rover = next($this->rovers));

        return new self($rovers);
    }
}
