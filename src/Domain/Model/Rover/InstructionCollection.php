<?php

namespace RoverControlPanel\Domain\Model\Rover;

class InstructionCollection
{
    /** @var array */
    private $instructions;

    private function __construct(array $instructions)
    {
        $this->instructions = $instructions;
    }

    public static function build(array $instructions): self
    {
        $instructionsObjects = [];
        foreach ($instructions as $instruction) {
            $instructionsObjects[] = Instruction::build($instruction);
        }

        return new self($instructionsObjects);
    }

    public function isEmpty(): bool
    {
        return empty($this->instructions);
    }

    public function current(): Instruction
    {
        return current($this->instructions);
    }

    public function next(): void
    {
        next($this->instructions);
    }
}
