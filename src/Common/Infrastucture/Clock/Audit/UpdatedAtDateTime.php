<?php declare(strict_types=1);

namespace Star\DDDExample\Common\Infrastucture\Clock\Audit;

use DateTimeImmutable;
use DateTimeInterface;
use Star\DDDExample\Common\Domain\Model\Audit\AuditedAt;

final class UpdatedAtDateTime implements AuditedAt
{
    private DateTimeInterface $date;

    private function __construct(DateTimeInterface $date)
    {
        $this->date = $date;
    }

    public function toDateFormat(): string
    {
        return $this->date->format('Y-m-d');
    }

    public function toDateTimeFormat(): string
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    public static function fromNow(): self
    {
        return self::fromDateTime(new DateTimeImmutable());
    }

    public static function fromDateTime(DateTimeInterface $date): self
    {
        return new self($date);
    }

    public static function fromString(string $date): self
    {
        return self::fromDateTime(new DateTimeImmutable($date));
    }
}
