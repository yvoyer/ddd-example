<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game;

use Star\DDDExample\TicTacToe\Domain\Model\Game\GameAggregate;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameRepository;

final class CreateGameHandler
{
    private GameRepository $games;

    public function __construct(GameRepository $games)
    {
        $this->games = $games;
    }

    public function __invoke(CreateGame $command): void
    {
        $game = GameAggregate::created(
            $command->gameId(),
            $command->createdBy(),
            $command->createdAt()
        );

        $this->games->saveGame($game);
    }
}
