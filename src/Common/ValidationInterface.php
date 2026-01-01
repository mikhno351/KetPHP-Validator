<?php

declare(strict_types=1);

namespace KetPHP\Validator\Common;

interface ValidationInterface
{

    /**
     * Determines whether the given value is valid.
     *
     * @param mixed $value The value to validate.
     *
     * @return bool True if the value is a validated, false otherwise.
     */
    public function isValid(mixed $value): bool;

    /**
     * Returns the validation error message.
     *
     * @return string Error message describing the validation rule.
     */
    public function getErrorMessage(): string;
}