<?php

use App\BusinessRule\Matcher;
use App\BusinessRule\Matchers\AlwaysTrueMatcher;
use App\Item;

describe('Always True Matcher', function () {
    describe('class definition', function () {
        context('implements interface', function () {
            it('is a matcher', function() {
                $m = new AlwaysTrueMatcher();
                expect($m)->toBeAnInstanceOf(Matcher::class);
            });
        });
    });
    describe('is match', function () {
        context('normal Item', function () {
            it('matches a normal item', function () {
                $m = new AlwaysTrueMatcher();
                $is = $m->isMatch(new Item('normal', 10, 5));
                expect($is)->toBe(true);
            });
        });
        context('aged cheese Item', function () {
            it('matches an aged cheese item', function () {
                $m = new AlwaysTrueMatcher();
                $is = $m->isMatch(new Item('Aged Brie', 10, 5));
                expect($is)->toBe(true);
            });
        });
        context('legendary Item', function () {
            it('matches a legendary item', function () {
                $m = new AlwaysTrueMatcher();
                $is = $m->isMatch(new Item('Sulfuras, Hand of Ragnaros', 10, 5));
                expect($is)->toBe(true);
            });
        });
        context('concert ticket Item', function () {
            it('matches a concert ticket item', function () {
                $m = new AlwaysTrueMatcher();
                $is = $m->isMatch(new Item('Backstage passes to a TAFKAL80ETC concert', 10, 5));
                expect($is)->toBe(true);
            });
        });
        context('empty Item', function () {
            it('matches an empty item', function () {
                $m = new AlwaysTrueMatcher();
                $is = $m->isMatch(new Item('', 0, 0));
                expect($is)->toBe(true);
            });
        });
    });
});
