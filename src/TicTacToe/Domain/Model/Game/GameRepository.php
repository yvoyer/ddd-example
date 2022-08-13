<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Model\Game;

/**
 * The Write-only service used by the command handlers in "TicTacToe\Domain\Messaging\*".
 */
interface GameRepository
{
    public function getGameWithId(GameId $id): GameAggregate;

    public function saveGame(GameAggregate $game): void;
}
