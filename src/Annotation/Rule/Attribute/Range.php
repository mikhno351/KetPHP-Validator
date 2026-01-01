<?php

declare(strict_types=1);

namespace KetPHP\Validator\Annotation\Rule\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Range extends Rule
{

    public function __construct(float|int $min = PHP_INT_MIN, float|int $max = PHP_INT_MAX)
    {
        parent::__construct(\KetPHP\Validator\Annotation\Rule\Range::class, $min, $max);
    }
}