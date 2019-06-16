<?php

namespace App\BusinessRule;

use App\Item;

interface Updater
{
    /**
     * @param Item $item
     * @return void
     */
    public function update(Item $item);
}
