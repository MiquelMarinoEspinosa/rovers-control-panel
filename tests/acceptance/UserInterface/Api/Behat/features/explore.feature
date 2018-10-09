Feature: Rover Control Panel Acceptance Test

  Scenario: Make Rover Squad Explore Plateau
    Given rover squad positions and instructions
    | plateau | position1 | instructions1 | position2 | instructions2 |
    |  5 5    |   1 2 N   |   LMLMLMLMM   |  3 3 E    |  MMRMMRMRRM   |
    When order to the rover squad explore
    Then the positions of the the rovers are updated
    | position1 | position2 |
    |   1 3 N   |   5 1 E   |