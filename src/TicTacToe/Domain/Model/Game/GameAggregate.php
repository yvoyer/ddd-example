<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Model\Game;

use Star\DDDExample\Common\Domain\Model\Audit\AuditedAt;
use Star\DDDExample\Common\Domain\Model\Audit\AuditedBy;
use function count;

final class GameAggregate
{
    private GameId $id;
    private bool $state = false;
    /**
     * @var PlayerId[] Indexed by positions
     */
    private array $plays = [];

    private function __construct(GameId $id)
    {
        $this->id = $id;
    }

    public function getIdentity(): GameId
    {
        return $this->id;
    }

    public function start(
        PlayerId $playerOne,
        PlayerId $playerTwo,
        AuditedBy $startedBy,
        AuditedAt $startedAt
    ): void {
        $this->state = true;
    }

    public function end(AuditedBy $endedBy, AuditedAt $endedAt): void
    {
        $this->state = false;
    }

    public function isEnded(): bool
    {
        return !$this->isStarted();
    }

    public function isStarted(): bool
    {
        return $this->state;
    }

    public function play(Position $position, PlayerId $playerId, AuditedAt $playedAt): void
    {
        $this->plays[$position->toInt()] = $playerId->toString();
        if (count($this->plays) === 9) {
            $this->end($playerId, $playedAt);
        }
    }

    public static function created(GameId $id, AuditedBy $createdBy, AuditedAt $createdAt): self
    {
        return new self($id);
    }

    public static function started(
        GameId $id,
        PlayerId $playerOne,
        PlayerId $playerTwo,
        AuditedBy $createdBy,
        AuditedAt $createdAt
    ): self {
        $game = self::created($id, $createdBy, $createdAt);
        $game->start($playerOne, $playerTwo, $createdBy, $createdAt);

        return $game;
    }

    public static function ended(
        GameId $id,
        PlayerId $playerOne,
        PlayerId $playerTwo,
        AuditedBy $createdBy,
        AuditedAt $createdAt
    ): self {
        $game = self::started($id, $playerOne, $playerTwo, $createdBy, $createdAt);
        $game->end($createdBy, $createdAt);

        return $game;
    }
}
