<?php declare(strict_types=1);

use Star\DDDExample\TicTacToe\Domain\Model\Game\PlayerId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\Position;

/**
 * Defines application features from the specific context.
 */
abstract class FeatureContext
{
    /**
     * @Given the game is created
     */
    public function theGameIsCreated(): void
    {
        $this->whenTheGameIsCreated();
    }

    abstract protected function whenTheGameIsCreated(): void;

    /**
     * @Given The game is not started
     */
    public function theGameIsNotStarted(): void
    {
        $this->assertGameIsNotStarted();
    }

    abstract protected function assertGameIsNotStarted(): void;

    /**
     * @When Players :arg1 and :arg2 are starting the game
     */
    public function playersAreStartingTheGame(string $playerOne, string $playerTwo): void
    {
        $this->whenPlayersAreStartingTheGame(PlayerId::fromString($playerOne), PlayerId::fromString($playerTwo));
    }

    abstract protected function whenPlayersAreStartingTheGame(PlayerId $playerOne, PlayerId $playerTwo): void;

    /**
     * @Then The game should be started
     */
    public function theGameShouldBeStarted(): void
    {
        $this->assertTheGameIsStarted();
    }

    abstract protected function assertTheGameIsStarted(): void;

    /**
     * @When Player :arg1 plays on :arg2
     */
    public function playerPlaysOn(string $playerId, string $position): void
    {
        $this->whenPlayerPlaysTurn(PlayerId::fromString($playerId), Position::fromString($position));
    }

    abstract protected function whenPlayerPlaysTurn(PlayerId $playerId, Position $position): void;

    /**
     * @Then The game should be ended
     */
    public function theGameShouldBeEnded(): void
    {
        $this->assertTheGameShouldBeEnded();
    }

    abstract protected function assertTheGameShouldBeEnded(): void;

    /**
     * @Then The result should be a tie
     */
    public function theResultShouldBeATie(): void
    {
        $this->assertTheGameIsATie();
    }

    abstract protected function assertTheGameIsATie(): void;

    /**
     * @Then The result should be a win for player :arg1
     */
    public function theResultShouldBeAWinForPlayer(string $winner): void
    {
        $this->assertTheGameIsAWin(PlayerId::fromString($winner));
    }

    abstract protected function assertTheGameIsAWin(PlayerId $winner): void;
}
