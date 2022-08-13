<?php declare(strict_types=1);

namespace Star\DDExample\TicTacToe\Domain\Model\Game;

use PHPUnit\Framework\TestCase;
use Star\DDDExample\Common\Domain\Model\Audit\AuditedAt;
use Star\DDDExample\Common\Domain\Model\Audit\AuditedBy;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameAggregate;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\PlayerId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\Position;

final class GameAggregateTest extends TestCase
{
    public function test_it_should_start_the_game(): void
    {
        $game = GameAggregate::created(
            GameId::random(),
            $this->createMock(AuditedBy::class),
            $this->createMock(AuditedAt::class)
        );
        $game->start(
            PlayerId::random(),
            PlayerId::random(),
            $this->createMock(AuditedBy::class),
            $this->createMock(AuditedAt::class)
        );

        self::assertTrue($game->isStarted());
    }

    public function test_it_should_end_the_game(): void
    {
        $game = GameAggregate::started(
            GameId::random(),
            PlayerId::random(),
            PlayerId::random(),
            $this->createMock(AuditedBy::class),
            $this->createMock(AuditedAt::class)
        );
        $game->end(
            $this->createMock(AuditedBy::class),
            $this->createMock(AuditedAt::class)
        );

        self::assertTrue($game->isEnded());
    }

    public function test_it_should_play_move(): void
    {
        $game = GameAggregate::started(
            GameId::random(),
            PlayerId::random(),
            PlayerId::random(),
            $this->createMock(AuditedBy::class),
            $this->createMock(AuditedAt::class)
        );
        $game->play(
            Position::fromInt(1),
            PlayerId::fromString('X'),
            $this->createMock(AuditedAt::class)
        );

        self::assertFalse($game->isEnded());
        self::assertTrue($game->isStarted());
    }

    public function test_it_should_end_the_game_after_9_turns(): void
    {
        $game = GameAggregate::started(
            GameId::random(),
            PlayerId::random(),
            PlayerId::random(),
            $this->createMock(AuditedBy::class),
            $this->createMock(AuditedAt::class)
        );

        $game->play(
            Position::fromInt(1),
            PlayerId::fromString('X'),
            $this->createMock(AuditedAt::class)
        );
        self::assertFalse($game->isEnded());

        $game->play(
            Position::fromInt(2),
            PlayerId::fromString('O'),
            $this->createMock(AuditedAt::class)
        );
        self::assertFalse($game->isEnded());

        $game->play(
            Position::fromInt(3),
            PlayerId::fromString('X'),
            $this->createMock(AuditedAt::class)
        );
        self::assertFalse($game->isEnded());

        $game->play(
            Position::fromInt(4),
            PlayerId::fromString('O'),
            $this->createMock(AuditedAt::class)
        );
        self::assertFalse($game->isEnded());

        $game->play(
            Position::fromInt(5),
            PlayerId::fromString('X'),
            $this->createMock(AuditedAt::class)
        );
        self::assertFalse($game->isEnded());

        $game->play(
            Position::fromInt(6),
            PlayerId::fromString('O'),
            $this->createMock(AuditedAt::class)
        );
        self::assertFalse($game->isEnded());

        $game->play(
            Position::fromInt(7),
            PlayerId::fromString('X'),
            $this->createMock(AuditedAt::class)
        );
        self::assertFalse($game->isEnded());

        $game->play(
            Position::fromInt(8),
            PlayerId::fromString('O'),
            $this->createMock(AuditedAt::class)
        );
        self::assertFalse($game->isEnded());

        $game->play(
            Position::fromInt(9),
            PlayerId::fromString('X'),
            $this->createMock(AuditedAt::class)
        );
        self::assertTrue($game->isEnded());
    }
}
