<?php

namespace RoverControlPanel\Tests\Acceptance\UserInterface\Api\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;

class RoverControlPanelContext implements Context
{
    /** @var string */
    private $name;
    /** @var string */
    private $id;
    /** @var string */
    private $request;
    /** @var string */
    private $response;

    /**
     * @Given /^rover squad positions and instructions$/
     */
    public function roverSquadPositionsAndInstructions(TableNode $table)
    {
        $request = $table->getColumnsHash()[0];
        $requestAsArray = [];
        $requestAsArray['plateau'] = $request['plateau'];
        $requestAsArray['roverSquad'][] = [
            'position' => $request['position1'],
            'instructions' => $request['instructions1']
        ];
        $requestAsArray['roverSquad'][] = [
            'position' => $request['position2'],
            'instructions' => $request['instructions2']
        ];

        $this->request = json_encode($requestAsArray);
    }

    /**
     * @When /^order to the rover squad explore$/
     */
    public function orderToTheRoverSquadExplore()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://rovers-control-panel.nasa.org/explore");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $this->request
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $this->response = curl_exec($ch);
    }

    /**
     * @Then /^the positions of the the rovers are updated$/
     */
    public function thePositionsOfTheTheRoversAreUpdated(TableNode $table)
    {
        $expectedResponse = $table->getColumnsHash()[0];
        $responseAsArray = json_decode($this->response, true);
        $positions = $responseAsArray['roverSquad'];
        if ($positions[0]['position'] !== $expectedResponse['position1']) {
            throw new \Exception(
                'The expected position does not mathc with the current.' . PHP_EOL
                . ' Given: ' . $positions[0]['position'] . PHP_EOL
                . ' Expected: ' . $expectedResponse['position1'] . PHP_EOL
            );
        }

        if ($positions[1]['position'] !== $expectedResponse['position2']) {
            throw new \Exception(
                'The expected position does not mathc with the current.' . PHP_EOL
                . ' Given: ' . $expectedResponse['position2'] . PHP_EOL
                . ' Expected: ' . $positions[1]['position'] . PHP_EOL
            );
        }
    }
}
