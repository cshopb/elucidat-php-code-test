<?php

namespace App\BusinessRule\Matchers;

use App\BusinessRule\Matcher;
use App\Item;

class QualityLessThanMaximumMatcher implements Matcher
{
    /** @var int */
    private $comparisonValue = 50;

    /** @inheritdoc */
    public function isMatch(Item $item)
    {
        return ($item->quality < $this->comparisonValue);
    }
}
