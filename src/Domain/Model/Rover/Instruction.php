<?php

namespace RoverControlPanel\Domain\Model\Rover;

class Instruction
{
    /** @var Movement[] */
    private $movements;

    private function __construct(array $movements)
    {
        $this->movements = $movements;
    }

    public static function build($movements): self
    {
        $movementsAsArray = [];
        foreach ($movements as $movement) {
            try {
                $movementsAsArray[] = new Movement($movement);
            } catch (\InvalidArgumentException $invalidArgumentException) {
                throw new \InvalidArgumentException(
                    'INSTRUCTION create error: ' . $invalidArgumentException . PHP_EOL
                    . 'Given Value: ' . implode(',', $movements)
                );
            }
        }

        return new self($movementsAsArray);
    }

    public function isEmpty(): bool
    {
        return empty($this->movements);
    }

    public function current(): Movement
    {
        return current($this->movements);
    }

    public function next()
    {
        next($this->movements);
    }
}
