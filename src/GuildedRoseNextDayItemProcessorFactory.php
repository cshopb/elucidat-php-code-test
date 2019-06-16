<?php

namespace App;

use App\BusinessRule\Matchers\AlwaysTrueMatcher;
use App\BusinessRule\Matchers\CompositeAndMatcher;
use App\BusinessRule\Matchers\NameIsExactlyMatcher;
use App\BusinessRule\Matchers\QualityGreaterThanValueMatcher;
use App\BusinessRule\Matchers\QualityLessThanMaximumMatcher;
use App\BusinessRule\Matchers\SellInLessThanEqualToValueMatcher;
use App\BusinessRule\Rule;
use App\BusinessRule\Updaters\QualityAbsoluteUpdater;
use App\BusinessRule\Updaters\QualityDeltaUpdater;
use App\BusinessRule\Updaters\SellInDeltaUpdater;

class GuildedRoseNextDayItemProcessorFactory
{
    /** @return GuildedRoseNextDayItemProcessor[] */
    public function createItems()
    {
        return [
            'Legendary item' => new GuildedRoseNextDayItemProcessor(
                new NameIsExactlyMatcher('Sulfuras, Hand of Ragnaros'),
                []
            ),

            'Ageing Cheese' => new GuildedRoseNextDayItemProcessor(
                new NameIsExactlyMatcher('Aged Brie'),
                [
                    new Rule(
                        new QualityLessThanMaximumMatcher(),
                        new QualityDeltaUpdater(1)
                    ),
                    new Rule(
                        new CompositeAndMatcher(
                            [
                                new QualityLessThanMaximumMatcher(),
                                new SellInLessThanEqualToValueMatcher(1),
                            ]
                        ),
                        new QualityDeltaUpdater(1)
                    ),
                    new Rule(
                        new AlwaysTrueMatcher(),
                        new SellInDeltaUpdater(-1)
                    ),
                ]
            ),

            'Concert Ticket' => new GuildedRoseNextDayItemProcessor(
                new NameIsExactlyMatcher('Backstage passes to a TAFKAL80ETC concert'),
                [
                    new Rule(
                        new QualityLessThanMaximumMatcher(),
                        new QualityDeltaUpdater(1)
                    ),
                    new Rule(
                        new CompositeAndMatcher(
                            [
                                new QualityLessThanMaximumMatcher(),
                                new SellInLessThanEqualToValueMatcher(10),
                            ]
                        ),
                        new QualityDeltaUpdater(1)
                    ),
                    new Rule(
                        new CompositeAndMatcher(
                            [
                                new QualityLessThanMaximumMatcher(),
                                new SellInLessThanEqualToValueMatcher(5),
                            ]
                        ),
                        new QualityDeltaUpdater(1)
                    ),
                    new Rule(
                        new SellInLessThanEqualToValueMatcher(0),
                        new QualityAbsoluteUpdater(0)
                    ),
                    new Rule(
                        new AlwaysTrueMatcher(),
                        new SellInDeltaUpdater(-1)
                    ),
                ]
            ),

            'All normal items (Default)' => new GuildedRoseNextDayItemProcessor(
                new AlwaysTrueMatcher(),
                [
                    new Rule(
                        new QualityGreaterThanValueMatcher(0),
                        new QualityDeltaUpdater(-1)
                    ),
                    new Rule(
                        new CompositeAndMatcher(
                            [
                                new QualityGreaterThanValueMatcher(0),
                                new SellInLessThanEqualToValueMatcher(0),
                            ]
                        ),
                        new QualityDeltaUpdater(-1)
                    ),
                    new Rule(
                        new AlwaysTrueMatcher(),
                        new SellInDeltaUpdater(-1)
                    ),
                ]
            ),
        ];
    }
}
