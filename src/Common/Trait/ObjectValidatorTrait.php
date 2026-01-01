<?php

declare(strict_types=1);

namespace KetPHP\Validator\Common\Trait;

use KetPHP\Validator\Common\ValidationAttributeInterface;
use KetPHP\Validator\Context\Result;
use KetPHP\Validator\Context\Violation;
use ReflectionAttribute;
use ReflectionClass;

/**
 * @template T of object
 */
trait ObjectValidatorTrait
{

    /**
     * @param T $object
     * @return Result|T
     */
    public static function of(object $object)
    {
        $violations = [];
        $ref = new ReflectionClass($object);

        foreach ($ref->getProperties() as $property) {
            $value = $property->getValue($object);

            foreach ($property->getAttributes(ValidationAttributeInterface::class, ReflectionAttribute::IS_INSTANCEOF) as $attr) {
                /** @var ValidationAttributeInterface $attribute */
                if ($violation = $attr->newInstance()->toRule()->validate($value)) {
                    $violations[] = new Violation($violation->getMessage(), $violation->getCode(), array_merge($violation->getParams(), ['property' => $property->getName()]));
                }
            }
        }

        $result = new Result($violations);

        return $result->isValid() ? $object : $result;
    }
}