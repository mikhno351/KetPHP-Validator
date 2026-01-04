# KetPHP-Validator
KetPHP Validator is a lightweight and highly typed validation library.

![Packagist Version](https://img.shields.io/packagist/v/ket-php/validator)
![Packagist Downloads](https://img.shields.io/packagist/dt/ket-php/validator?logo=packagist&logoColor=white)
![Static Badge](https://img.shields.io/badge/PHP-8.1-777BB4?logo=php&logoColor=white)

## Opportunities
- Validation of values and objects
- PHP 8 Attributes support
- Extensible validation rules
- Clear error model (`Result`/`Violation`)
- Optional stop at the first error
- No dependencies

The library is suitable for validating DTOs, Form Objects, Request objects, and any input data.

## Supported rules
| Rule          | Description             |
| ------------- | ----------------------- |
| `NotBlank`    | Value must not be empty |
| `MinLength`   | Minimum line length     |
| `MaxLength`   | Maximum line length     |
| `Range`       | Range of numbers        |
| `Optional`    | Makes the rule optional |

## Installation
Install via Composer:
```
composer require ket-php/validator
```

## Usage
### Validation of the value
```php
use KetPHP\Validator\Validator;
use KetPHP\Validator\Annotation\Rule\MaxLength;
use KetPHP\Validator\Annotation\Rule\NotBlank;

$result = Validator::create('Hello world')->add(new NotBlank())->add(new MaxLength(5))->validate(); // returned Result

if ($result->isValid() === false) {
    foreach ($result->all() as $violation) {
        echo $violation->getMessage();
        print_r($violation->getParams());
    }
}
```
### Validation of the object via attributes
Object:
```php
use KetPHP\Validator\Annotation\Rule\Attribute\MaxLength;
use KetPHP\Validator\Annotation\Rule\Attribute\NotBlank;
use KetPHP\Validator\Annotation\Rule\Attribute\Range;

final class UserDto
{
    #[NotBlank]
    #[MaxLength(50)]
    public string $name;

    #[Range(min: 18, max: 99)]
    public int $age;
}
```
Example:
```php
use KetPHP\Validator\Validator;
use KetPHP\Validator\Context\Result;

$user = new UserDto();
$user->name = '';
$user->age = 15;

$result = Validator::of($user); // returned UserDto (if valid) or Result (if invalid)

if ($result instanceof Result) {
    foreach ($result->all() as $violation) {
        echo $violation->getMessage();
        print_r($violation->getParams());
    }
}
```
### Optional (nullable values)
Example:
```php
use KetPHP\Validator\Annotation\Rule\Optional;
use KetPHP\Validator\Annotation\Rule\MaxLength;

$rule = new Optional(new MaxLength(10));
```
Attribute:
```php
#[Optional(new MaxLength(10))]
public ?string $comment;
```
### Error model
```php
new Violation(
    message: 'Max length is {max}',             // string
    code: 'max_length',                         // string|int
    params: ['max' => 10, 'property' => 'name'] // array
);
```
Result:
```php
$result->isValid(); // bool
$result->all();     // Violation[]
```

## Creating your own rule
### Rule
```php
use KetPHP\Validator\Common\ValidationRuleInterface;
use KetPHP\Validator\Context\Violation;

final class StartsWithA implements ValidationRuleInterface
{

    public function validate(mixed $value): ?Violation
    {
        if (str_starts_with($value, 'A') === false) {
            return new Violation('Value must start with letter A', 'starts_with_a');
        }

        return null;
    }
}
```
### Attribute
```php
use KetPHP\Validator\Annotation\Rule\Attribute\Rule;
use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class StartsWithA extends Rule
{

    public function __construct()
    {
        parent::__construct(\Your\App\StartsWithA::class);
    }
}
```
### Using
Rule:
```php
$rule = new StartsWithA();
$rule->validate('Architecture');     // null
$rule->validate('Non Architecture'); // Violation
```
Attribute:
```php
use KetPHP\Validator\Annotation\Rule\Attribute\Rule;
use Your\App\StartsWithA;

#[StartsWithA]              // With your attribute
#[Rule(StartsWithA::class)] // Without your attribute
public string $code;
```
