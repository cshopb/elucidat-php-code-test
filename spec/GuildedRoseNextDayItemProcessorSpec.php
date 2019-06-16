<?php

use App\BusinessRule\Exceptions\ArrayDoesNotContainAllInstancesOfClassException;
use App\BusinessRule\Matchers\AlwaysTrueMatcher as ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework;
use App\GuildedRoseNextDayItemProcessor;

describe('Guilded Rose Next Day Item Processor', function () {
    describe('create', function () {
        context('validates injected rules', function () {
            it('throws an exception if the injected rule is invalid', function() {
                expect(function() {
                    new GuildedRoseNextDayItemProcessor(
                        new ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework(),
                        [new stdClass()]
                    );
                })->toThrow(new ArrayDoesNotContainAllInstancesOfClassException());
            });
            it('throws an exception if one of the injected rules is invalid', function() {
                expect(function() {
                    new GuildedRoseNextDayItemProcessor(
                        new ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework(),
                        [
                            new ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework(),
                            new stdClass()
                        ]
                    );
                })->toThrow(new ArrayDoesNotContainAllInstancesOfClassException());
            });
            it('rules can be an empty array (NO-OP)', function() {
                new GuildedRoseNextDayItemProcessor(
                    new ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework(),
                    []
                );
            });
        });
    });
});
