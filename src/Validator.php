<?php

declare(strict_types=1);

namespace KetPHP\Validator;

use KetPHP\Validator\Common\Trait\ObjectValidatorTrait;
use KetPHP\Validator\Common\ValidationRuleInterface;
use KetPHP\Validator\Context\Result;

class Validator
{

    use ObjectValidatorTrait;

    /** @var ValidationRuleInterface[] */
    private array $rules = [];

    /**
     * @param mixed $value The value to validate.
     */
    public function __construct(
        private readonly mixed $value,
        private readonly bool  $stopOnFirstError = false
    )
    {
    }

    /**
     * @param mixed $value The value to validate.
     */
    public static function create(mixed $value, bool $stopOnFirstError = false): self
    {
        return new self($value, $stopOnFirstError);
    }

    public function add(ValidationRuleInterface $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }

    public function validate(): Result
    {
        $errors = [];

        foreach ($this->rules as $rule) {
            if (($violation = $rule->validate($this->value)) !== null) {
                $errors[] = $violation;
                if ($this->stopOnFirstError) {
                    break;
                }
            }
        }

        return new Result($errors);
    }
}