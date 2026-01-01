<?php

declare(strict_types=1);

namespace KetPHP\Validator;

use Doctrine\Common\Collections\ArrayCollection;
use KetPHP\Validator\Common\ValidationInterface;

/**
 * Executes a set of validation rules against a given value.
 *
 * The Validator acts as a composite, allowing multiple implementations of
 * {@see ValidationInterface} to be applied to a single value. Each failed
 * validation rule contributes an error message to the result collection.
 */
class Validator
{

    /** @var ValidationInterface[] $validations */
    protected readonly array $validations;

    /**
     * Validator constructor.
     *
     * @param ValidationInterface ...$validations One or more validation rules.
     */
    public function __construct(ValidationInterface ...$validations)
    {
        $this->validations = $validations;
    }

    /**
     * Creates a new Validator instance.
     *
     * This is a named constructor that provides a more expressive way
     * to create a validator with a predefined set of validation rules.
     *
     * @param ValidationInterface ...$validations One or more validation rules.
     *
     * @return static
     */
    public static function newInstance(ValidationInterface ...$validations): self
    {
        return new self(...$validations);
    }

    /**
     * Validates the given value against all configured validation rules.
     *
     * Each validation rule is executed sequentially. If a rule fails,
     * its error message is added to the returned collection.
     *
     * @param mixed $value The value to validate.
     *
     * @return ArrayCollection<int, string> A collection of validation error messages (check `isEmpty()`).
     */
    public function validate(mixed $value): ArrayCollection
    {
        $errors = new ArrayCollection();

        foreach ($this->validations as $validation) {
            if ($validation instanceof ValidationInterface && $validation->isValid($value) === false) {
                $errors->add($validation->getErrorMessage());
            }
        }

        return $errors;
    }
}