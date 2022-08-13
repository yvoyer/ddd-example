<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game;

use Star\DDDExample\Common\Domain\Model\Audit\AuditedAt;
use Star\DDDExample\Common\Domain\Model\Audit\AuditedBy;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameId;

final class EndGame
{
    private GameId $gameId;
    private AuditedBy $endedBy;
    private AuditedAt $endedAt;

    public function __construct(
        GameId $gameId,
        AuditedBy $endedBy,
        AuditedAt $endedAt
    ) {
        $this->gameId = $gameId;
        $this->endedBy = $endedBy;
        $this->endedAt = $endedAt;
    }

    final public function gameId(): GameId
    {
        return $this->gameId;
    }

    final public function endedBy(): AuditedBy
    {
        return $this->endedBy;
    }

    final public function endedAt(): AuditedAt
    {
        return $this->endedAt;
    }
}
