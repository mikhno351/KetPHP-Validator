<?php

declare(strict_types=1);

namespace KetPHP\Validator\Common\Validation\String;

use KetPHP\Validator\Common\ValidationInterface;

final class MinLength implements ValidationInterface
{

    public function __construct(private readonly int $length)
    {
    }

    /**
     * @inheritdoc
     */
    public function isValid(mixed $value): bool
    {
        return is_string($value) && (mb_strlen($value) ?: 0) >= $this->length;
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage(): string
    {
        return sprintf('The passed value must not be shorter than (%d) characters.', $this->length);
    }
}