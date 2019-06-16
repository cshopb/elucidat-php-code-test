<?php

use App\BusinessRule\Exceptions\ScalarMustBeAnIntegerException;
use App\BusinessRule\Matcher;
use App\BusinessRule\Matchers\QualityGreaterThanValueMatcher;
use App\Item;

describe('Quality Greater Than Value Matcher', function () {
    describe('class definition', function () {
        context('implements interface', function () {
            it('is a matcher', function() {
                $m = new QualityGreaterThanValueMatcher(0);
                expect($m)->toBeAnInstanceOf(Matcher::class);
            });
        });
        context('parameter must be an integer', function () {
            it('rejects a non-scalar value', function() {
                expect(function() {
                    new QualityGreaterThanValueMatcher(new stdClass());
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects a non-numeric scalar', function() {
                expect(function() {
                    new QualityGreaterThanValueMatcher('abcd');
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects a float (as string)', function() {
                expect(function() {
                    new QualityGreaterThanValueMatcher('1.23');
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects a float (as float)', function() {
                expect(function() {
                    new QualityGreaterThanValueMatcher(1.23);
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects an integer with a prefix', function() {
                expect(function() {
                    new QualityGreaterThanValueMatcher('abcd1234');
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('rejects an integer with a suffix', function() {
                expect(function() {
                    new QualityGreaterThanValueMatcher('1234abcd');
                })->toThrow(new ScalarMustBeAnIntegerException());
            });
            it('accepts a positive integer (as int)', function() {
                new QualityGreaterThanValueMatcher(1);
            });
            it('accepts zero (as int)', function() {
                new QualityGreaterThanValueMatcher(0);
            });
            it('accepts a negative integer (as int)', function() {
                new QualityGreaterThanValueMatcher(-1);
            });
            it('accepts a positive integer (as string)', function() {
                new QualityGreaterThanValueMatcher('1');
            });
            it('accepts zero (as string)', function() {
                new QualityGreaterThanValueMatcher('0');
            });
            it('accepts a negative integer (as string)', function() {
                new QualityGreaterThanValueMatcher('-1');
            });
        });        
    });
    describe('is match', function () {
        context('greater than equal to zero', function () {
            it('will not match when quality is zero', function() {
                $m = new QualityGreaterThanValueMatcher(0);
                $item = new Item('Name', 0, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('will not match when quality is only just negative', function() {
                $m = new QualityGreaterThanValueMatcher(0);
                $item = new Item('Name', -1, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('will not match when quality is greatly negative', function() {
                $m = new QualityGreaterThanValueMatcher(0);
                $item = new Item('Name', -11, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('will match when quality is only just positive', function() {
                $m = new QualityGreaterThanValueMatcher(0);
                $item = new Item('Name', 1, 0);
                expect($m->isMatch($item))->toBe(true);
            });
            it('will match when quality is greatly positive', function() {
                $m = new QualityGreaterThanValueMatcher(0);
                $item = new Item('Name', 11, 0);
                expect($m->isMatch($item))->toBe(true);
            });
        });
    });
});
