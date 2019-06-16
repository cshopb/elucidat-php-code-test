<?php

namespace App\BusinessRule\Updaters;

use App\BusinessRule\Updater;
use App\Item;

class SellInDeltaUpdater implements Updater
{
    /** @var int */
    private $deltaValue;

    public function __construct($deltaValue)
    {
        $this->deltaValue = $deltaValue;
    }

    /** @inheritdoc */
    public function update(Item $item)
    {
        $item->sellIn += $this->deltaValue;
    }
}
