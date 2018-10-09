<?php

namespace RoverControlPanel\UserInterface\Api;

use RoverControlPanel\Application\DataTransformer\Rover\RoverSquadResource;
use RoverControlPanel\Application\UseCase\Rover\RoverSquadExplorationRequest;
use RoverControlPanel\Application\UseCase\Rover\RoverSquadExplorationUseCase;
use RoverControlPanel\Domain\Model\Rover\MoveRoverError;
use RoverControlPanel\Domain\Model\Rover\PositionOutOfTheMap;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

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
        try {
            $currentRequest = $this->requestStack->getCurrentRequest();
            $requestBody = json_decode(
                $currentRequest->getContent(),
                true
            );

            $roverSquadExplorationRequest = $this->buildRoverSquadExplorationRequest(
                $requestBody
            );

            $roverSquadResource = $this->roverSquadExplorationUseCase->execute(
                $roverSquadExplorationRequest
            );

            return new JsonResponse(
                $this->buildResponse(
                    $roverSquadResource
                )
            );
        } catch (\Exception $exception) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            if ($exception instanceof \InvalidArgumentException
                || $exception instanceof PositionOutOfTheMap
                || $exception instanceof MoveRoverError
            ) {
                $statusCode = Response::HTTP_BAD_REQUEST;
            }

            return new JsonResponse(
                [
                    'error' => [
                        'code' => $statusCode,
                        'message' => $exception->getMessage()
                    ]
                ],
                $statusCode
            );
        }
    }

    private function buildRoverSquadExplorationRequest($requestBody): RoverSquadExplorationRequest
    {
        $plateau = explode(" ", $requestBody["plateau"]);
        $positions = [];
        $instructions = [];
        foreach ($requestBody["roverSquad"] as $rover) {
            $positions[] = explode(' ', $rover["position"]);
            $instructions[] = str_split($rover["instructions"]);
        }

        return new RoverSquadExplorationRequest(
            $plateau[0],
            $plateau[1],
            $positions,
            $instructions
        );
    }

    private function buildResponse(RoverSquadResource $roverSquadResource): array
    {
        $roverSquadAsArray = [];
        foreach ($roverSquadResource->getRoverResources() as $roverResource) {
            $position = [
                $roverResource->getAbscissa(),
                $roverResource->getOrdinate(),
                $roverResource->getCardinal()
            ];
            $positionAsString = implode(' ', $position);
            $roverSquadAsArray[] = [
                'position' => $positionAsString
            ];
        }

        return  ['roverSquad' => $roverSquadAsArray];
    }
}
