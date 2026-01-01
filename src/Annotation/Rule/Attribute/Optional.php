<?php

declare(strict_types=1);

namespace KetPHP\Validator\Annotation\Rule\Attribute;

use Attribute;
use KetPHP\Validator\Common\ValidationAttributeInterface;
use KetPHP\Validator\Common\ValidationRuleInterface;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Optional implements ValidationAttributeInterface
{

    public function __construct(private readonly ValidationRuleInterface $innerRule)
    {
    }

    public function toRule(): ValidationRuleInterface
    {
        return new \KetPHP\Validator\Annotation\Rule\Optional($this->innerRule);
    }
}