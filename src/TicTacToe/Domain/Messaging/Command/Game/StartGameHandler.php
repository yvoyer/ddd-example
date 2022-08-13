<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game;

use Star\DDDExample\TicTacToe\Domain\Model\Game\GameRepository;

final class StartGameHandler
{
    private GameRepository $games;

    public function __construct(GameRepository $games)
    {
        $this->games = $games;
    }

    public function __invoke(StartGame $command): void
    {
        $game = $this->games->getGameWithId($command->gameId());
        $game->start(
            $command->playerOne(),
            $command->playerTwo(),
            $command->startedBy(),
            $command->startedAt()
        );

        $this->games->saveGame($game);
    }
}
