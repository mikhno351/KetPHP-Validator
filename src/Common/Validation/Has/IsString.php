<?php

declare(strict_types=1);

namespace KetPHP\Validator\Common\Validation\Has;

use KetPHP\Validator\Common\ValidationInterface;

final class IsString implements ValidationInterface
{

    /**
     * @inheritdoc
     */
    public function isValid(mixed $value): bool
    {
        return is_string($value);
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage(): string
    {
        return 'The passed value is not a string.';
    }
}