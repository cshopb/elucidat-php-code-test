<?php

namespace App\BusinessRule\Traits;

use App\BusinessRule\Exceptions\ScalarMustBeAnIntegerException;

trait ScalarMustBeAnIntegerTrait
{
    private function assertScalarIsAnInteger($value)
    {
        if (!is_scalar($value) ||
            (!is_numeric($value)) ||
            (!(preg_match('#^-?\d+$#', $value) && is_int((int) $value)))
        ) {
            throw new ScalarMustBeAnIntegerException();
        }
    }
}
