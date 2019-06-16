<?php

namespace App;

class GildedRose
{
    /** @var Item[] */
    private $items;
    /** @var GuildedRoseNextDayItemProcessor[] */
    private $itemProcessors;

    public function __construct(array $items, array $itemProcessors)
    {
        $this->items = $items;
        $this->itemProcessors = $itemProcessors;
    }

    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    public function nextDay()
    {
        foreach ($this->items as $item) {
            foreach ($this->itemProcessors as $itemProcessor) {
                if ($itemProcessor->isMyItem($item)) {
                    $itemProcessor->process($item);
                    break;
                }
            }
        }
    }
}
