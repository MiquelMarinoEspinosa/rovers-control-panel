<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Instruction;
use RoverControlPanel\Domain\Model\Rover\Movement;

class InstructionTest extends TestCase
{
    public function testEmptyMovementsShouldReturnAnEmptyInstruction()
    {
        $movementsAsString = [];
        $instruction = Instruction::build($movementsAsString);
        $this->assertTrue(
            $instruction->isEmpty()
        );
    }

    public function testNotEmptyMovementsShouldReturnAnNotEmptyInstruction()
    {
        $movementsAsString = ['L'];
        $instruction = Instruction::build($movementsAsString);
        $this->assertFalse(
            $instruction->isEmpty()
        );
    }

    public function testSomeValidMovementShouldThrownAnException()
    {
        $movementsAsString = ['L','R','M','F'];
        try {
            Instruction::build($movementsAsString);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'instruction')
            );
        }
    }

    public function testShouldReturnTheNextMovement()
    {
        $movementsAsString = ['L','R','M','R'];
        $instruction = Instruction::build($movementsAsString);
        $instruction->next();
        $movement = $instruction->current();
        $this->assertEquals(
            'R',
            $movement->value()
        );
    }

    public function testShouldReturnTheMovements()
    {
        $movementsAsString = ['L','R','M','R'];
        $instruction = Instruction::build($movementsAsString);
        $movements = [];
        foreach ($movementsAsString as $movmentAsString) {
            $movements[] = new Movement($movmentAsString);
        }

        $this->assertEquals(
            $movements,
            $instruction->movements()
        );
    }
}
