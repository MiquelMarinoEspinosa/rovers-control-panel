<?php

namespace RoverControlPanel\UserInterface\Api;

use RoverControlPanel\Application\UseCase\Rover\RoverSquadExplorationUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class RoverControlPanelController
{
    /** @var RequestStack */
    private $requestStack;
    /** @var RoverSquadExplorationUseCase */
    private $roverSquadExplorationUseCase;

    public function __construct(
        RequestStack $requestStack,
        RoverSquadExplorationUseCase $roverSquadExplorationUseCase
    ) {
        $this->requestStack = $requestStack;
        $this->roverSquadExplorationUseCase = $roverSquadExplorationUseCase;
    }

    public function postAction()
    {
        $currentRequest = $this->requestStack->getCurrentRequest();

        return new JsonResponse(
            [
                'roverSquad' => [
                    [
                        'position' => '1 2 N'
                    ],
                    [
                        'position' => '5 1 E'
                    ]
                ]
            ]
        );
    }
}