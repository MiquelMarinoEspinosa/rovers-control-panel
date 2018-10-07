<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Instruction;

class InstructionTest extends TestCase
{
    public function testEmptyMovementsShouldReturnAnEmptyInstruction()
    {
        $movementsAsString = '';
        $instruction = Instruction::create($movementsAsString);
        $this->assertTrue(
            $instruction->isEmpty()
        );
    }

    public function testNotEmptyMovementsShouldReturnAnNotEmptyInstruction()
    {
        $movementsAsString = 'L';
        $instruction = Instruction::create($movementsAsString);
        $this->assertFalse(
            $instruction->isEmpty()
        );
    }

    public function testSomeValidMovementShouldThrownAnException()
    {
        $movementsAsString = 'LRMF';
        try {
            Instruction::create($movementsAsString);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $this->assertNotFalse(
                strpos(strtolower($invalidArgumentException->getMessage()), 'instruction')
            );
        }
    }

    public function testShouldReturnTheNextMovement()
    {
        $movementsAsString = 'LRMR';
        $instruction = Instruction::create($movementsAsString);
        $instruction->next();
        $movement = $instruction->current();
        $this->assertEquals(
            'R',
            $movement->value()
        );
    }
}
