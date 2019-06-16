<?php

namespace App\BusinessRule\Matchers;

use App\BusinessRule\Matcher;
use App\Item;

class AlwaysTrueMatcher implements Matcher
{
    /** @inheritdoc */
    public function isMatch(Item $item)
    {
        return true;
    }
}
