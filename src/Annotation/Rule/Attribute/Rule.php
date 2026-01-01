<?php

namespace KetPHP\Validator\Annotation\Rule\Attribute;

use Attribute;
use InvalidArgumentException;
use KetPHP\Validator\Common\ValidationAttributeInterface;
use KetPHP\Validator\Common\ValidationRuleInterface;

/**
 * @template T of ValidationRuleInterface
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Rule implements ValidationAttributeInterface
{

    /** @var array<int, mixed> $arguments */
    private readonly array $arguments;

    /**
     * @param class-string<T> $ruleClass
     * @param mixed ...$args
     */
    public function __construct(private readonly string $ruleClass, mixed ...$args)
    {
        if (is_subclass_of($ruleClass, ValidationRuleInterface::class) === false) {
            throw new InvalidArgumentException(sprintf('Class %s must implement %s', $ruleClass, ValidationRuleInterface::class));
        }

        $this->arguments = $args;
    }

    /**
     * @return T
     */
    public function toRule(): ValidationRuleInterface
    {
        return new ($this->ruleClass)(...$this->arguments);
    }
}