<?php

namespace RoverControlPanel\Tests\Unit\Domain\Model\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Domain\Model\Rover\Instruction;
use RoverControlPanel\Domain\Model\Rover\InstructionCollection;

class InstructionCollectionTest extends TestCase
{
    public function testShouldReturnAnEmptyCollection()
    {
        $this->assertTrue(
            (InstructionCollection::build([]))->isEmpty()
        );
    }

    public function testShouldReturnANotEmptyCollection()
    {
        $instructionAsArray = ['L','R','M'];
        $this->assertFalse(
            (InstructionCollection::build([$instructionAsArray]))->isEmpty()
        );
    }

    public function testShouldReturnTheCurrentValue()
    {
        $instructionAsArray = ['L','R','M'];
        $instruction = Instruction::build($instructionAsArray);
        $instructionCollection = InstructionCollection::build([$instructionAsArray]);
        $this->assertEquals(
            $instruction,
            $instructionCollection->current()
        );
    }

    public function testShouldReturnTheNextValue()
    {
        $instructionAsArray = ['M','R','L'];
        $anotherInstructionAsArray = ['L','R','M'];
        $anotherInstruction = Instruction::build($instructionAsArray);
        $instructionCollection = InstructionCollection::build([$anotherInstructionAsArray, $instructionAsArray]);
        $instructionCollection->next();
        $this->assertEquals(
            $anotherInstruction,
            $instructionCollection->current()
        );
    }
}
