<?php

declare(strict_types=1);

namespace KetPHP\Validator\Common\Validation\String;

use KetPHP\Validator\Common\ValidationInterface;

/**
 * Validates that a string does not exceed the specified maximum length.
 *
 * This validator checks whether the given value is a string and ensures
 * that its length (calculated using mb_strlen) is less than or equal to
 * the configured maximum length.
 */
final class MaxLength implements ValidationInterface
{

    /**
     * Maximum allowed string length.
     *
     * @param int $length Maximum number of characters allowed.
     */
    public function __construct(private readonly int $length)
    {
    }

    /**
     * @inheritdoc
     */
    public function isValid(mixed $value): bool
    {
        return is_string($value) && (mb_strlen($value) ?: 0) <= $this->length;
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage(): string
    {
        return sprintf('The passed value must not exceed (%d) characters.', $this->length);
    }
}