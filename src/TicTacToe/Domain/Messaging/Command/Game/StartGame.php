<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game;

use Star\DDDExample\Common\Domain\Model\Audit\AuditedAt;
use Star\DDDExample\Common\Domain\Model\Audit\AuditedBy;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\PlayerId;

final class StartGame
{
    private GameId $gameId;
    private PlayerId $playerOne;
    private PlayerId $playerTwo;
    private AuditedBy $startedBy;
    private AuditedAt $startedAt;

    public function __construct(
        GameId $gameId,
        PlayerId $playerOne,
        PlayerId $playerTwo,
        AuditedBy $startedBy,
        AuditedAt $startedAt
    ) {
        $this->gameId = $gameId;
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
        $this->startedBy = $startedBy;
        $this->startedAt = $startedAt;
    }

    final public function gameId(): GameId
    {
        return $this->gameId;
    }

    final public function playerOne(): PlayerId
    {
        return $this->playerOne;
    }

    final public function playerTwo(): PlayerId
    {
        return $this->playerTwo;
    }

    final public function startedBy(): AuditedBy
    {
        return $this->startedBy;
    }

    final public function startedAt(): AuditedAt
    {
        return $this->startedAt;
    }
}
