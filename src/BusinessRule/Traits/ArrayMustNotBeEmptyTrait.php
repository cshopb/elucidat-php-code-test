<?php

namespace App\BusinessRule\Traits;

use App\BusinessRule\Exceptions\ArrayMustNotBeEmptyException;

trait ArrayMustNotBeEmptyTrait
{
    private function assertArrayIsNotEmpty(array $subjects)
    {
        if (count($subjects) === 0) {
            throw new ArrayMustNotBeEmptyException();
        }
    }
}
