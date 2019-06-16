<?php

namespace App\BusinessRule\Updaters;

use App\BusinessRule\Updater;
use App\Item;

class QualityAbsoluteUpdater implements Updater
{
    /** @var int */
    private $absoluteValue;

    public function __construct($absoluteValue)
    {
        $this->absoluteValue = $absoluteValue;
    }

    /** @inheritdoc */
    public function update(Item $item)
    {
        $item->quality = $this->absoluteValue;
    }
}
