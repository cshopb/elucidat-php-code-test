<?php

namespace App;

class GildedRose
{
    /** @var Item[] */
    private $items;

    const MAXIMUM_QUALITY = 50;
    const MINIMUM_QUALITY = 0;
    const NEXT_DAY_DELTA = -1;

    public function __construct(array $items)
    {
        $this->items = $items;
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

            if ($item->name === 'Sulfuras, Hand of Ragnaros') {
                // do nothing
                continue;
            }

            switch ($item->name) {
                case 'Aged Brie':
                    $this->processAgeingCheese($item);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->processConcertTicket($item);
                    break;
                default:
                    $this->processNormalItem($item);
                    break;
            }

            $this->assignSellInDelta($item, self::NEXT_DAY_DELTA);
        }
    }

    private function processAgeingCheese(Item $item)
    {
        $qualityDelta = 1;
        if ($this->isSellInPast($item)) {
            $qualityDelta += 1;
        }
        $this->assignQualityDelta($item, $qualityDelta);
    }

    private function processConcertTicket(Item $item)
    {
        if ($this->isSellInPast($item)) {
            $this->assignQualityAbsolute($item, self::MINIMUM_QUALITY);
        } else {
            $qualityDelta = 1;
            if ($item->sellIn < 11) {
                $qualityDelta++;
            }
            if ($item->sellIn < 6) {
                $qualityDelta++;
            }
            $this->assignQualityDelta($item, $qualityDelta);
        }
    }

    private function processNormalItem(Item $item)
    {
        $qualityDelta = -1;
        if ($this->isSellInPast($item)) {
            $qualityDelta -= 1;
        }
        $this->assignQualityDelta($item, $qualityDelta);
    }

    private function isSellInPast(Item $item)
    {
        return $item->sellIn <= 0;
    }

    private function assignSellInDelta(Item $item, $delta)
    {
        $item->sellIn = $item->sellIn + $delta;
    }

    private function assignQualityDelta(Item $item, $delta)
    {
        $item->quality = $this->forceQualityIntoValidBoundaries($item->quality + $delta);
    }

    private function assignQualityAbsolute(Item $item, $absolute)
    {
        $item->quality = $this->forceQualityIntoValidBoundaries($absolute);
    }

    private function forceQualityIntoValidBoundaries($quality)
    {
        $forced = $quality;
        if ($quality < self::MINIMUM_QUALITY) {
            $forced = self::MINIMUM_QUALITY;
        }
        if ($quality > self::MAXIMUM_QUALITY) {
            $forced = self::MAXIMUM_QUALITY;
        }
        return $forced;
    }
}
