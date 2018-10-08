<?php

namespace RoverControlPanel\Application\UseCase\Rover;

use RoverControlPanel\Application\DataTransformer\Rover\RoverSquadDataTransformer;
use RoverControlPanel\Domain\Model\Rover\InstructionCollection;
use RoverControlPanel\Domain\Model\Rover\RoverSquad;

class RoverSquadExplorationUseCase
{
    /** @var RoverSquadDataTransformer */
    private $roverSquadDataTransformer;

    public function __construct(
        RoverSquadDataTransformer $roverSquadDataTransformer
    ) {
        $this->roverSquadDataTransformer = $roverSquadDataTransformer;
    }

    public function execute(
        RoverSquadExplorationRequest $roverSquadExploreRequest
    ) {
        $instructionCollection = InstructionCollection::build(
            $roverSquadExploreRequest->instructions()
        );
        $plateau = [
            $roverSquadExploreRequest->plateauTopRightAbscissa(),
            $roverSquadExploreRequest->plateauTopRightOrdinate()
        ];

        $roverSquad = RoverSquad::build(
            $plateau,
            $roverSquadExploreRequest->positions()
        );

        $roverSquad = $roverSquad->explore($instructionCollection);

        return $this->roverSquadDataTransformer->transform(
            $roverSquad
        );
    }
}
