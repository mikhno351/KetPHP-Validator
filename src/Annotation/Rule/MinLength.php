<?php

declare(strict_types=1);

namespace KetPHP\Validator\Annotation\Rule;

use KetPHP\Validator\Common\ValidationRuleInterface;
use KetPHP\Validator\Context\Violation;

final class MinLength implements ValidationRuleInterface
{

    public function __construct(private readonly int $length)
    {
    }

    public function validate(mixed $value): ?Violation
    {
        if (is_string($value) === false) {
            return new Violation('Value must be a string', 'string_required');
        }
        if (mb_strlen($value) < $this->length) {
            return new Violation('Value must have at least {min} characters', 'length', ['min' => $this->length]
            );
        }

        return null;
    }
}