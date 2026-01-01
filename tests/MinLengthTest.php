<?php

declare(strict_types=1);

use KetPHP\Validator\Annotation\Rule\Attribute\MinLength as MinLengthAttribute;
use KetPHP\Validator\Annotation\Rule\MinLength as MinLengthRule;
use KetPHP\Validator\Context\Violation;
use KetPHP\Validator\Validator;
use PHPUnit\Framework\TestCase;

class MinLengthTest extends TestCase
{


    public function testValid(): void
    {
        $user = new class {
            #[MinLengthAttribute(8)]
            public string $name = 'Alice Cooper';
        };

        $validator = Validator::create($user->name)->add($rule = new MinLengthRule(8));

        $this->assertTrue($validator->validate()->isValid());
        $this->assertNull($rule->validate($user->name));
        $this->assertSame($user, Validator::of($user));
    }

    public function testInValid(): void
    {
        $user = new class {
            #[MinLengthAttribute(8)]
            public string $name = 'Alice';
        };

        $validator = Validator::create($user->name)->add($rule = new MinLengthRule(8));

        $this->assertFalse($validator->validate()->isValid());
        $this->assertInstanceOf(Violation::class, $rule->validate($user->name));
        $this->assertNotSame($user, Validator::of($user));
    }
}