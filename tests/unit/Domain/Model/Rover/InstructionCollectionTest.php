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
            (InstructionCollection::create([]))->isEmpty()
        );
    }

    public function testShouldReturnANotEmptyCollection()
    {
        $this->assertFalse(
            (InstructionCollection::create(['LRM']))->isEmpty()
        );
    }

    public function testShouldReturnTheCurrentValue()
    {
        $instruction = Instruction::create('LRM');
        $instructionCollection = InstructionCollection::create(['LRM']);
        $this->assertEquals(
            $instruction,
            $instructionCollection->current()
        );
    }

    public function testShouldReturnTheNextValue()
    {
        $anotherInstruction = Instruction::create('MRL');
        $instructionCollection = InstructionCollection::create(['LRM', 'MRL']);
        $instructionCollection->next();
        $this->assertEquals(
            $anotherInstruction,
            $instructionCollection->current()
        );
    }
}
