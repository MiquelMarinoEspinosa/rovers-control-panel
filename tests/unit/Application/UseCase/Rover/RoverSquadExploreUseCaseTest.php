<?php

namespace RoverControlPanel\Tests\Unit\Application\UseCase\Rover;

use PHPUnit\Framework\TestCase;
use RoverControlPanel\Application\DataTransformer\Rover\RoverResource;
use RoverControlPanel\Application\DataTransformer\Rover\RoverSquadDataTransformer;
use RoverControlPanel\Application\DataTransformer\Rover\RoverSquadResource;
use RoverControlPanel\Application\UseCase\Rover\ExplorationError;
use RoverControlPanel\Application\UseCase\Rover\RoverSquadExplorationRequest;
use RoverControlPanel\Application\UseCase\Rover\RoverSquadExplorationUseCase;

class RoverSquadExploreUseCaseTest extends TestCase
{
    public function testShouldExploreThePlateau()
    {
        $plateauTopRightAbscissa = 5;
        $plateauTopRightOrdinate = 5;
        $positions = [
            [1, 2, 'N'],
            [3, 3, 'E']
        ];
        $instructions = [
            ['L','M','L','M','L','M','L','M','M'],
            ['M','M','R','M','M','R','M','R','R','M']
        ];

        $roverSquadExploreRequest = new RoverSquadExplorationRequest(
            $plateauTopRightAbscissa,
            $plateauTopRightOrdinate,
            $positions,
            $instructions
        );

        $roverResources = [
            new RoverResource(1, 3, 'N'),
            new RoverResource(5, 1, 'E')
        ];

        $roverSquadResource = new RoverSquadResource($roverResources);
        $roverSquadDataTransformer = new RoverSquadDataTransformer();
        $roverSquadExplorationUseCase = new RoverSquadExplorationUseCase($roverSquadDataTransformer);

        $this->assertEquals(
            $roverSquadResource,
            $roverSquadExplorationUseCase->execute($roverSquadExploreRequest)
        );
    }
}
