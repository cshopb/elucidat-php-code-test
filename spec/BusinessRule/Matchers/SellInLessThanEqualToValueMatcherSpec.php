<?php

use App\BusinessRule\Exceptions\ScalarMustBeAnIntegerException;
use App\BusinessRule\Matcher;
use App\BusinessRule\Matchers\SellInLessThanEqualToValueMatcher;
use App\Item;

describe('Sell In Less Than Equal To Value Matcher', function () {
    describe('class definition', function () {
        context('implements interface', function () {
            it('is a matcher', function() {
                $m = new SellInLessThanEqualToValueMatcher(0);
                expect($m)->toBeAnInstanceOf(Matcher::class);
            });
        });
        context('parameter must be an integer', function () {
            it('rejects a non-scalar value', function() {
               expect(function() {
                   new SellInLessThanEqualToValueMatcher(new stdClass());
               })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects a non-numeric scalar', function() {
                expect(function() {
                    new SellInLessThanEqualToValueMatcher('abcd');
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects a float (as string)', function() {
                expect(function() {
                    new SellInLessThanEqualToValueMatcher('1.23');
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects a float (as float)', function() {
                expect(function() {
                    new SellInLessThanEqualToValueMatcher(1.23);
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects an integer with a prefix', function() {
                 expect(function() {
                    new SellInLessThanEqualToValueMatcher('abcd1234');
                 })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects an integer with a suffix', function() {
                expect(function() {
                    new SellInLessThanEqualToValueMatcher('1234abcd');
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('accepts a positive integer (as int)', function() {
                new SellInLessThanEqualToValueMatcher(1);
            });
            it('accepts zero (as int)', function() {
                new SellInLessThanEqualToValueMatcher(0);
            });
            it('accepts a negative integer (as int)', function() {
                new SellInLessThanEqualToValueMatcher(-1);
            });
            it('accepts a positive integer (as string)', function() {
                new SellInLessThanEqualToValueMatcher('1');
            });
            it('accepts zero (as string)', function() {
                new SellInLessThanEqualToValueMatcher('0');
            });
            it('accepts a negative integer (as string)', function() {
                new SellInLessThanEqualToValueMatcher('-1');
            });
        });
    });
    describe('is match', function () {
        context('matches when the item value is less than matcher value', function() {
            it('match when both are the same, positive', function() {
                $m = new SellInLessThanEqualToValueMatcher(1);
                $item = new Item('Name', 0, 1);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when both are the same, negative', function() {
                $m = new SellInLessThanEqualToValueMatcher(-1);
                $item = new Item('Name', 0, -1);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when both are the same, zero', function() {
                $m = new SellInLessThanEqualToValueMatcher(0);
                $item = new Item('Name', 0, 0);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when less than and signs are different', function() {
                $m = new SellInLessThanEqualToValueMatcher(1);
                $item = new Item('Name', 0, -2);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when both less than and signs are same - positive', function() {
                $m = new SellInLessThanEqualToValueMatcher(2);
                $item = new Item('Name', 0, 1);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when both less than and signs are same - negative', function() {
                $m = new SellInLessThanEqualToValueMatcher(-1);
                $item = new Item('Name', 0, -2);
                expect($m->isMatch($item))->toBe(true);
            });
        });
        context('matches as expected when the parameter was a string', function() {
            it('match when both are the same, positive', function() {
                $m = new SellInLessThanEqualToValueMatcher('1');
                $item = new Item('Name', 0, 1);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when both are the same, negative', function() {
                $m = new SellInLessThanEqualToValueMatcher('-1');
                $item = new Item('Name', 0, -1);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when both are the same, zero', function() {
                $m = new SellInLessThanEqualToValueMatcher('0');
                $item = new Item('Name', 0, 0);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when less than and signs are different', function() {
                $m = new SellInLessThanEqualToValueMatcher('1');
                $item = new Item('Name', 0, -2);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when both less than and signs are same - positive', function() {
                $m = new SellInLessThanEqualToValueMatcher('2');
                $item = new Item('Name', 0, 1);
                expect($m->isMatch($item))->toBe(true);
            });
            it('match when both less than and signs are same - negative', function() {
                $m = new SellInLessThanEqualToValueMatcher('-1');
                $item = new Item('Name', 0, -2);
                expect($m->isMatch($item))->toBe(true);
            });

        });
    });
});
