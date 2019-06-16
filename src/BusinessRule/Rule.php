<?php

namespace App\BusinessRule;

use App\Item;

class Rule
{
    /** @var Matcher */
    private $matcher;
    /** @var Updater */
    private $updater;

    public function __construct(Matcher $matcher, Updater $updater)
    {
        $this->matcher = $matcher;
        $this->updater = $updater;
    }

    public function apply(Item $item)
    {
        if ($this->matcher->isMatch($item)) {
            $this->updater->update(($item));
        }
    }
}
