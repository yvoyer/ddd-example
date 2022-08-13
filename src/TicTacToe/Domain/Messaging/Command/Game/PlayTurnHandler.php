<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game;

use Star\DDDExample\TicTacToe\Domain\Model\Game\GameRepository;

final class PlayTurnHandler
{
    private GameRepository $games;

    public function __construct(GameRepository $games)
    {
        $this->games = $games;
    }

    public function __invoke(PlayTurn $command): void
    {
        $game = $this->games->getGameWithId($command->gameId());
        $game->play($command->position(), $command->playerId(), $command->playedAt());

        $this->games->saveGame($game);
    }
}
