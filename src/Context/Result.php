<?php

declare(strict_types=1);

namespace KetPHP\Validator\Context;

final class Result
{

    /** @param Violation[] $violations */
    public function __construct(private readonly array $violations)
    {
    }

    public function isValid(): bool
    {
        return count($this->violations) === 0;
    }

    /** @return Violation[] */
    public function all(): array
    {
        return $this->violations;
    }
}
