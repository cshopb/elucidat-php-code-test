<?php

use App\BusinessRule\Matcher;
use App\BusinessRule\Matchers\QualityLessThanMaximumMatcher;
use App\Item;

describe('Quality Less Than Maximum Matcher', function () {
    describe('class definition', function () {
        context('implements interface', function () {
            it('is a matcher', function() {
                $m = new QualityLessThanMaximumMatcher();
                expect($m)->toBeAnInstanceOf(Matcher::class);
            });
        });
    });
    describe('is match', function () {
        context('greater than equal to zero', function () {
            it('will not match when quality is exactly 50', function() {
                $m = new QualityLessThanMaximumMatcher();
                $item = new Item('Name', 50, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('will not match when quality is only just greater than 50', function() {
                $m = new QualityLessThanMaximumMatcher();
                $item = new Item('Name', 51, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('will not match when quality is much greater than 50', function() {
                $m = new QualityLessThanMaximumMatcher();
                $item = new Item('Name', 101, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('will match when quality is only just less than 50', function() {
                $m = new QualityLessThanMaximumMatcher();
                $item = new Item('Name', 49, 0);
                expect($m->isMatch($item))->toBe(true);
            });
            it('will match when quality is much less than 50', function() {
                $m = new QualityLessThanMaximumMatcher();
                $item = new Item('Name', 1, 0);
                expect($m->isMatch($item))->toBe(true);
            });
            it('will match when quality is negative', function() {
                $m = new QualityLessThanMaximumMatcher();
                $item = new Item('Name', -999, 0);
                expect($m->isMatch($item))->toBe(true);
            });
        });
    });
});
