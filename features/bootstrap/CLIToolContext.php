<?php declare(strict_types=1);

use Behat\Behat\Context\Context;
use Star\DDDExample\TicTacToe\Domain\Model\Game\PlayerId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\Position;

/**
 * Integration tests for the cli tool.
 */
final class CLIToolContext extends FeatureContext implements Context
{
    protected function whenTheGameIsCreated(): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    protected function assertGameIsNotStarted(): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    protected function whenPlayersAreStartingTheGame(PlayerId $playerOne, PlayerId $playerTwo): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    protected function assertTheGameIsStarted(): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    protected function whenPlayerPlaysTurn(PlayerId $playerId, Position $position): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    protected function assertTheGameShouldBeEnded(): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    protected function assertTheGameIsATie(): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    protected function assertTheGameIsAWin(PlayerId $winner): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }
}
