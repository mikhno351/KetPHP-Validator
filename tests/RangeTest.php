<?php

declare(strict_types=1);

use KetPHP\Validator\Annotation\Rule\Attribute\Range as RangeAttribute;
use KetPHP\Validator\Annotation\Rule\Range as RangeRule;
use KetPHP\Validator\Context\Violation;
use KetPHP\Validator\Validator;
use PHPUnit\Framework\TestCase;

class RangeTest extends TestCase
{

    public function testValid(): void
    {
        $user = new class {
            #[RangeAttribute(12, 120)]
            public int $age = 23;
        };

        $validator = Validator::create($user->age)->add($rule = new RangeRule(12, 120));

        $this->assertTrue($validator->validate()->isValid());
        $this->assertNull($rule->validate($user->age));
        $this->assertSame($user, Validator::of($user));
    }

    public function testFloatValid(): void
    {
        $user = new class {
            #[RangeAttribute(-400.50, 9000.20)]
            public float $amount = 250.24;
        };

        $validator = Validator::create($user->amount)->add($rule = new RangeRule(-400.50, 9000.20));

        $this->assertTrue($validator->validate()->isValid());
        $this->assertNull($rule->validate($user->amount));
        $this->assertSame($user, Validator::of($user));
    }

    public function testInValid(): void
    {
        $user = new class {
            #[RangeAttribute(12, 120)]
            public int $age = 9;
        };

        $validator = Validator::create($user->age)->add($rule = new RangeRule(12, 120));

        $this->assertFalse($validator->validate()->isValid());
        $this->assertInstanceOf(Violation::class, $rule->validate($user->age));
        $this->assertNotSame($user, Validator::of($user));
    }

    public function testFloatInValid(): void
    {
        $user = new class {
            #[RangeAttribute(-400.50, 9000.20)]
            public float $amount = -540.45;
        };

        $validator = Validator::create($user->amount)->add($rule = new RangeRule(-400.50, 9000.20));

        $this->assertFalse($validator->validate()->isValid());
        $this->assertInstanceOf(Violation::class, $rule->validate($user->amount));
        $this->assertNotSame($user, Validator::of($user));
    }
}