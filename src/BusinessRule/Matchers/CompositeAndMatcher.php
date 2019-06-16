<?php

namespace App\BusinessRule\Matchers;

use App\BusinessRule\Exceptions\BusinessRuleException;
use App\BusinessRule\Matcher;
use App\BusinessRule\Traits\ArrayMustContainAllInstancesOfClassTrait;
use App\BusinessRule\Traits\ArrayMustNotBeEmptyTrait;
use App\Item;

class CompositeAndMatcher implements Matcher
{
    use ArrayMustContainAllInstancesOfClassTrait, ArrayMustNotBeEmptyTrait;

    /** @var Matcher[] */
    private $matchers;

    /**
     * @param Matcher[]
     * @throws BusinessRuleException
     */
    public function __construct(array $matchers)
    {
        $this->assertArrayIsNotEmpty($matchers);
        $this->assertArrayContainsAllInstancesOfClass($matchers, Matcher::class);
        $this->matchers = $matchers;
    }

    /** @inheritdoc */
    public function isMatch(Item $item)
    {
        foreach ($this->matchers as $matcher) {
            if (!$matcher->isMatch($item)) {
                return false;
            }
        }

        return true;
    }
}
