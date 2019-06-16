<?php

use App\GuildedRoseNextDayItemProcessor;
use App\GuildedRoseNextDayItemProcessorFactory;

describe('Guilded Rose Next Day Item Processor Factory', function () {
    describe('createItems', function () {
        context('runs without error', function () {
            it('returns an non-empty array', function() {
                $processors = (new GuildedRoseNextDayItemProcessorFactory())->createItems();
                expect(count($processors))->toBeGreaterThan(0);
            });
            it('returns an array of processors', function() {
                $processors = (new GuildedRoseNextDayItemProcessorFactory())->createItems();
                foreach ($processors as $processor) {
                    expect($processor)->toBeAnInstanceOf(GuildedRoseNextDayItemProcessor::class);
                }
            });
        });
    });
});
