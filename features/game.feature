Feature: Play the Tic-Tac-Toe game

  Background:
    Given the game is created

  Scenario: Start a game
    Given The game is not started
    When Players "p1" and "p2" are starting the game
    Then The game should be started

  #   X | O | X
  #  --------------
  #   X | O | O
  #  --------------
  #   O | X | X
  Scenario: End in a tie
    Given The game is not started
    When Players "X" and "O" are starting the game
    And Player "X" plays on "TOP_LEFT"
    And Player "O" plays on "TOP_CENTER"
    And Player "X" plays on "TOP_RIGHT"
    And Player "O" plays on "MIDDLE_CENTER"
    And Player "X" plays on "MIDDLE_LEFT"
    And Player "O" plays on "MIDDLE_RIGHT"
    And Player "X" plays on "BOTTOM_RIGHT"
    And Player "O" plays on "BOTTOM_LEFT"
    And Player "X" plays on "BOTTOM_CENTER"
    Then The game should be ended
    And The result should be a tie

  #   X | O | X
  #  --------------
  #   O | X | O
  #  --------------
  #   O | X | X
  Scenario: End in a win
    Given The game is not started
    When Players "X" and "O" are starting the game
    And Player "X" plays on "TOP_LEFT"
    And Player "O" plays on "TOP_CENTER"
    And Player "X" plays on "TOP_RIGHT"
    And Player "O" plays on "MIDDLE_LEFT"
    And Player "X" plays on "MIDDLE_CENTER"
    And Player "O" plays on "MIDDLE_RIGHT"
    And Player "X" plays on "BOTTOM_RIGHT"
    And Player "O" plays on "BOTTOM_LEFT"
    And Player "X" plays on "BOTTOM_CENTER"
    Then The game should be ended
    And The result should be a win for player "X"
