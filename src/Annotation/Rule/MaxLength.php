<?php

declare(strict_types=1);

namespace KetPHP\Validator\Annotation\Rule;

use KetPHP\Validator\Common\ValidationRuleInterface;
use KetPHP\Validator\Context\Violation;

final class MaxLength implements ValidationRuleInterface
{

    public function __construct(private readonly int $length)
    {
    }

    public function validate(mixed $value): ?Violation
    {
        if (is_string($value) === false) {
            return new Violation('Value must be a string', 'string_required');
        }
        if (mb_strlen($value) > $this->length) {
            return new Violation('Max length is {max}', 'max_length', ['max' => $this->length]);
        }

        return null;
    }
}