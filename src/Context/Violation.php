<?php

declare(strict_types=1);

namespace KetPHP\Validator\Context;

final class Violation
{

    public function __construct(
        private readonly string     $message,
        private readonly int|string $code = 0,
        private readonly array      $params = []
    )
    {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCode(): int|string
    {
        return $this->code;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
