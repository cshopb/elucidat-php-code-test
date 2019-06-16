<?php

namespace App\BusinessRule\Matchers;

use App\BusinessRule\Matcher;
use App\Item;

class NameIsExactlyMatcher implements Matcher
{
    /** @var string */
    private $comparisonValue;

    public function __construct($comparisonValue)
    {
        $this->comparisonValue = $comparisonValue;
    }

    /** @inheritdoc */
    public function isMatch(Item $item)
    {
        return ($item->name === $this->comparisonValue);
    }
}
