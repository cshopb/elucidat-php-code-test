<?php

use App\BusinessRule\Exceptions\ArrayDoesNotContainAllInstancesOfClassException;
use App\BusinessRule\Exceptions\ArrayMustNotBeEmptyException;
use App\BusinessRule\Matcher;
use App\BusinessRule\Matchers\AlwaysTrueMatcher as ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework;
use App\BusinessRule\Matchers\AlwaysTrueMatcher;
use App\BusinessRule\Matchers\NameIsExactlyMatcher as MatcherUsedAsAlwaysFalseMatcher;
use App\BusinessRule\Matchers\CompositeAndMatcher;
use App\Item;

describe('Composite And Matcher', function () {
    describe('class definition', function () {
        context('implements interface', function () {
            it('is a matcher', function() {
                $m = new CompositeAndMatcher([new ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework()]);
                expect($m)->toBeAnInstanceOf(Matcher::class);
            });
        });
        context('validates injected matchers', function () {
            it('throws an exception if the injected matcher is invalid', function() {
                expect(function() {
                    new CompositeAndMatcher([new stdClass()]);
                })->toThrow(new ArrayDoesNotContainAllInstancesOfClassException());
            });
            it('throws an exception if one of the injected matchers is invalid', function() {
                expect(function() {
                    new CompositeAndMatcher([
                            new ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework(),
                            new stdClass()
                        ]
                    );
                })->toThrow(new ArrayDoesNotContainAllInstancesOfClassException());
            });
            it('at least one matcher must be injected', function() {
                expect(function() {
                    new CompositeAndMatcher([]);
                })->toThrow(new ArrayMustNotBeEmptyException());
            });
            it('matchers list must not be empty', function() {
                $m = new CompositeAndMatcher([new ArbitraryMatcherToWorkAroundLackOfTestDoubleInTestFramework()]);
                expect($m)->toBeAnInstanceOf(Matcher::class);
            });
        });
        context('composite enforces AND rule on matchers', function() {
            before(function() {
                $this->alwaysTrueMatcher = new AlwaysTrueMatcher();
                $this->alwaysFalseMatcher = new MatcherUsedAsAlwaysFalseMatcher('** ITEM NAME IS NEVER THIS **');
                $this->item = new Item('Name', 1, 2);
            });
            it('returns true if all matchers return true', function() {
                $m = new CompositeAndMatcher([$this->alwaysTrueMatcher, $this->alwaysTrueMatcher]);
                $is = $m->isMatch($this->item);
                expect($is)->toBe(true);
            });
            it('returns false if one of the matchers return false (first)', function() {
                $m = new CompositeAndMatcher([$this->alwaysFalseMatcher, $this->alwaysTrueMatcher]);
                $is = $m->isMatch($this->item);
                expect($is)->toBe(false);
            });
            it('returns false if one of the matchers return false (last)', function() {
                $m = new CompositeAndMatcher([$this->alwaysTrueMatcher, $this->alwaysFalseMatcher]);
                $is = $m->isMatch($this->item);
                expect($is)->toBe(false);
            });
            it('returns false if all of the matchers return false', function() {
                $m = new CompositeAndMatcher([$this->alwaysFalseMatcher, $this->alwaysFalseMatcher]);
                $is = $m->isMatch($this->item);
                expect($is)->toBe(false);
            });
        });
    });
});
