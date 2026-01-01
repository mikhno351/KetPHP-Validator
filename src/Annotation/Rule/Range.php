<?php

declare(strict_types=1);

namespace KetPHP\Validator\Annotation\Rule;

use KetPHP\Validator\Common\ValidationRuleInterface;
use KetPHP\Validator\Context\Violation;

final class Range implements ValidationRuleInterface
{
    public function __construct(
        private readonly float|int $min = PHP_INT_MIN,
        private readonly float|int $max = PHP_INT_MAX,
    )
    {
    }

    public function validate(mixed $value): ?Violation
    {
        if (is_numeric($value) === false) {
            return new Violation('Value must be numeric', 'numeric_required');
        }
        if ($value < $this->min || $value > $this->max) {
            return new Violation('Value must be between {min} and {max}', 'range', ['min' => $this->min, 'max' => $this->max]);
        }

        return null;
    }
}