<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game;

use Star\DDDExample\TicTacToe\Domain\Model\Game\GameRepository;

final class EndGameHandler
{
    private GameRepository $games;

    public function __construct(GameRepository $games)
    {
        $this->games = $games;
    }

    public function __invoke(EndGame $command): void
    {
        $game = $this->games->getGameWithId($command->gameId());

        $game->end($command->endedBy(), $command->endedAt());

        $this->games->saveGame($game);
    }
}
