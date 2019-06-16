<?php

namespace App\BusinessRule\Matchers;

use App\BusinessRule\Exceptions\BusinessRuleException;
use App\BusinessRule\Matcher;
use App\BusinessRule\Traits\ScalarMustBeAnIntegerTrait;
use App\Item;

class SellInLessThanEqualToValueMatcher implements Matcher
{
    use ScalarMustBeAnIntegerTrait;

    /** @var int */
    private $comparisonValue;

    /**
     * @param $comparisonValue
     * @throws BusinessRuleException
     */
    public function __construct($comparisonValue)
    {
        $this->assertScalarIsAnInteger($comparisonValue);
        $this->comparisonValue = (int)$comparisonValue;
    }

    /** @inheritdoc */
    public function isMatch(Item $item)
    {
        return ($item->sellIn <= $this->comparisonValue);
    }
}
