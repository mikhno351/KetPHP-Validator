<?php

declare(strict_types=1);

namespace KetPHP\Validator\Common;

use KetPHP\Validator\Context\Violation;

interface ValidationRuleInterface
{

    public function validate(mixed $value): ?Violation;
}