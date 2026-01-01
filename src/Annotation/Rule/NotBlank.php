<?php

namespace KetPHP\Validator\Annotation\Rule;

use KetPHP\Validator\Common\ValidationRuleInterface;
use KetPHP\Validator\Context\Violation;

final class NotBlank implements ValidationRuleInterface
{

    public function validate(mixed $value): ?Violation
    {
        if (is_string($value) === false) {
            return new Violation('Value must be a string', 'string_required');
        }
        if (trim($value) === '') {
            return new Violation('Value should not be blank', 'not_blank');
        }

        return null;
    }
}