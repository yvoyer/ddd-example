<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game;

use Star\DDDExample\Common\Domain\Model\Audit\AuditedAt;
use Star\DDDExample\Common\Domain\Model\Audit\AuditedBy;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameId;

final class CreateGame
{
    private GameId $gameId;
    private AuditedBy $createdBy;
    private AuditedAt $createdAt;

    public function __construct(
        GameId $gameId,
        AuditedBy $createdBy,
        AuditedAt $createdAt
    ) {
        $this->gameId = $gameId;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
    }

    final public function gameId(): GameId
    {
        return $this->gameId;
    }

    final public function createdBy(): AuditedBy
    {
        return $this->createdBy;
    }

    final public function createdAt(): AuditedAt
    {
        return $this->createdAt;
    }
}
