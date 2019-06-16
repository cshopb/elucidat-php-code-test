<?php

namespace App\BusinessRule;

use App\Item;

interface Matcher
{
    /**
     * @param Item $item
     * @return boolean
     */
    public function isMatch(Item $item);
}
