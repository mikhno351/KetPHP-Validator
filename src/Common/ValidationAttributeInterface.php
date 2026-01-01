<?php

declare(strict_types=1);

namespace KetPHP\Validator\Common;

interface ValidationAttributeInterface
{

    public function toRule(): ValidationRuleInterface;
}