<?php

declare(strict_types=1);

use KetPHP\Validator\Annotation\Rule\Attribute\NotBlank as NotBlankAttribute;
use KetPHP\Validator\Annotation\Rule\NotBlank as NotBlankRule;
use KetPHP\Validator\Context\Violation;
use KetPHP\Validator\Validator;
use PHPUnit\Framework\TestCase;

class NotBlankTest extends TestCase
{

    public function testValid(): void
    {
        $user = new class {
            #[NotBlankAttribute]
            public string $name = 'Alice Cooper';
        };

        $validator = Validator::create($user->name)->add($rule = new NotBlankRule());

        $this->assertTrue($validator->validate()->isValid());
        $this->assertNull($rule->validate($user->name));
        $this->assertSame($user, Validator::of($user));
    }

    public function testInValid(): void
    {
        $user = new class {
            #[NotBlankAttribute]
            public string $name = '';
        };

        $validator = Validator::create($user->name)->add($rule = new NotBlankRule());

        $this->assertFalse($validator->validate()->isValid());
        $this->assertInstanceOf(Violation::class, $rule->validate($user->name));
        $this->assertNotSame($user, Validator::of($user));
    }

    public function testNullInValid(): void
    {
        $user = new class {
            #[NotBlankAttribute]
            public ?string $name = null;
        };

        $validator = Validator::create($user->name)->add($rule = new NotBlankRule());

        $this->assertFalse($validator->validate()->isValid());
        $this->assertInstanceOf(Violation::class, $rule->validate($user->name));
        $this->assertNotSame($user, Validator::of($user));
    }
}