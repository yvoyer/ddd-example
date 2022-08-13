<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game;

use Star\DDDExample\Common\Domain\Model\Audit\AuditedAt;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\PlayerId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\Position;

final class PlayTurn
{
    private GameId $gameId;
    private Position $position;
    private PlayerId $playerId;
    private AuditedAt $playedAt;

    public function __construct(
        GameId $gameId,
        Position $position,
        PlayerId $playerId,
        AuditedAt $playedAt
    ) {
        $this->gameId = $gameId;
        $this->position = $position;
        $this->playerId = $playerId;
        $this->playedAt = $playedAt;
    }

    final public function gameId(): GameId
    {
        return $this->gameId;
    }

    final public function position(): Position
    {
        return $this->position;
    }

    final public function playerId(): PlayerId
    {
        return $this->playerId;
    }

    final public function playedAt(): AuditedAt
    {
        return $this->playedAt;
    }
}
