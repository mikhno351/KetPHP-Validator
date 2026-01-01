<?php

declare(strict_types=1);

namespace KetPHP\Validator\Annotation\Rule;

use KetPHP\Validator\Common\ValidationRuleInterface;
use KetPHP\Validator\Context\Violation;

final class Optional implements ValidationRuleInterface
{

    public function __construct(private readonly ValidationRuleInterface $innerRule)
    {
    }

    public function validate(mixed $value): ?Violation
    {
        if ($value === null) {
            return null;
        }

        return $this->innerRule->validate($value);
    }
}