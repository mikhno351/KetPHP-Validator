<?php

declare(strict_types=1);

namespace KetPHP\Validator\Common\Validation\Number;

use KetPHP\Validator\Common\ValidationInterface;

final class Range implements ValidationInterface
{

    public function __construct(private readonly float|int $min, private readonly float|int $max)
    {
    }

    /**
     * @inheritdoc
     */
    public function isValid(mixed $value): bool
    {
        return is_numeric($value) && (int)$value >= $this->min && (int)$value <= $this->max;
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage(): string
    {
        return sprintf('Value must be between (%d) and (%d).', $this->min, $this->max);
    }
}