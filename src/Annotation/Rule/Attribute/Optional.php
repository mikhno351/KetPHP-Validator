<?php

declare(strict_types=1);

namespace KetPHP\Validator\Annotation\Rule\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Optional extends Rule
{

    public function __construct(string $ruleClass, mixed ...$args)
    {
        parent::__construct(\KetPHP\Validator\Annotation\Rule\Optional::class, new $ruleClass(...$args));
    }
}