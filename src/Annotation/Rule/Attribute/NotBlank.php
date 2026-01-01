<?php

declare(strict_types=1);

namespace KetPHP\Validator\Annotation\Rule\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class NotBlank extends Rule
{

    public function __construct()
    {
        parent::__construct(\KetPHP\Validator\Annotation\Rule\NotBlank::class);
    }
}