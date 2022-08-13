<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Model\Game;

use Webmozart\Assert\Assert;
use function uniqid;

final class GameId
{
    private string $id;

    private function __construct(string $id)
    {
        Assert::notEmpty($id);
        $this->id = $id;
    }

    final public function toString(): string
    {
        return $this->id;
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public static function random(): self
    {
        return new self(uniqid('game_id-'));
    }
}
