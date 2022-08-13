<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Infrastructure\Persistence\InMemory;

use Star\DDDExample\TicTacToe\Domain\Model\Game\GameAggregate;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameRepository;

final class GameCollection implements GameRepository
{
    private array $games = [];

    public function getGameWithId(GameId $id): GameAggregate
    {
        return $this->games[$id->toString()];
    }

    public function saveGame(GameAggregate $game): void
    {
        $this->games[$game->getIdentity()->toString()] = $game;
    }
}
