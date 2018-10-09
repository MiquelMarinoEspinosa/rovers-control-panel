<?php

namespace RoverControlPanel\Application\DataTransformer\Rover;

class RoverSquadResource
{
    /** @var RoverResource[] */
    private $roverResources;

    public function __construct(array $roverResources)
    {
        $this->roverResources = $roverResources;
    }

    /**
     * @return RoverResource[]
     */
    public function getRoverResources(): array
    {
        return $this->roverResources;
    }
}
