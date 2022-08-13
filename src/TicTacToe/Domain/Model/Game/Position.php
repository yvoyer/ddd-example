<?php declare(strict_types=1);

namespace Star\DDDExample\TicTacToe\Domain\Model\Game;

use Webmozart\Assert\Assert;
use function constant;

final class Position
{
    /**
     * Available positions where a player may play their tokens.
     */
    public const TOP_LEFT = 1;
    public const TOP_CENTER = 2;
    public const TOP_RIGHT = 3;
    public const MIDDLE_LEFT = 4;
    public const MIDDLE_CENTER = 5;
    public const MIDDLE_RIGHT = 6;
    public const BOTTOM_LEFT = 7;
    public const BOTTOM_CENTER = 8;
    public const BOTTOM_RIGHT = 9;

    private int $position;

    private function __construct(int $position)
    {
        Assert::inArray(
            $position,
            [
                self::TOP_LEFT,
                self::TOP_CENTER,
                self::TOP_RIGHT,
                self::MIDDLE_LEFT,
                self::MIDDLE_CENTER,
                self::MIDDLE_RIGHT,
                self::BOTTOM_LEFT,
                self::BOTTOM_CENTER,
                self::BOTTOM_RIGHT,
            ]
        );
        $this->position = $position;
    }

    final public function toInt(): int
    {
        return $this->position;
    }

    public static function fromInt(int $position): self
    {
        return new self($position);
    }

    public static function fromString(string $position): self
    {
        return self::fromInt(constant(self::class . '::' . $position));
    }
}
