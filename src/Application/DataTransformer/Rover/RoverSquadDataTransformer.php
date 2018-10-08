<?php

namespace RoverControlPanel\Application\DataTransformer\Rover;

use RoverControlPanel\Domain\Model\Rover\RoverSquad;

class RoverSquadDataTransformer
{
    public function transform(RoverSquad $roverSquad): RoverSquadResource
    {
        $roverResources = [];
        $rover = $roverSquad->current();
        do {
            $roverResources[] = new RoverResource(
                $rover->abscissa(),
                $rover->ordinate(),
                $rover->cardinal()
            );
        } while ($rover = $roverSquad->next());

        return new RoverSquadResource($roverResources);
    }
}
