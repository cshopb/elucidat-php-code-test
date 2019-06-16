<?php

namespace App;

use App\BusinessRule\Exceptions\ArrayDoesNotContainAllInstancesOfClassException;
use App\BusinessRule\Matcher;
use App\BusinessRule\Rule;
use App\BusinessRule\Traits\ArrayMustContainAllInstancesOfClassTrait;

class GuildedRoseNextDayItemProcessor
{
    use ArrayMustContainAllInstancesOfClassTrait;

    /** @var Matcher */
    private $isMyItemMatcher;

    /** @var Rule[]  */
    private $rules = [];

    /**
     * @param Matcher $isMyItemMatcher
     * @param Rule[] $rules
     * @throws ArrayDoesNotContainAllInstancesOfClassException
     */
    public function __construct(Matcher $isMyItemMatcher, array $rules)
    {
        $this->assertArrayContainsAllInstancesOfClass($rules, Rule::class);
        $this->isMyItemMatcher = $isMyItemMatcher;
        $this->rules = $rules;
    }

    public function isMyItem(Item $item)
    {
        return $this->isMyItemMatcher->isMatch($item);
    }

    public function process(Item $item)
    {
        foreach ($this->rules as $rule) {
            $rule->apply($item);
        }
    }
}
