<?php

namespace App\BusinessRule\Traits;

use App\BusinessRule\Exceptions\ArrayDoesNotContainAllInstancesOfClassException;

trait ArrayMustContainAllInstancesOfClassTrait
{
    private function assertArrayContainsAllInstancesOfClass(array $subjects, $class)
    {
        foreach ($subjects as $subject) {
            if (!is_a($subject, $class)) {
                throw new ArrayDoesNotContainAllInstancesOfClassException();
            }
        }
    }
}
