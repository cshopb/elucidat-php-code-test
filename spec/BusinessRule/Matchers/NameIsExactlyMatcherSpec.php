<?php

use App\BusinessRule\Matcher;
use App\BusinessRule\Matchers\NameIsExactlyMatcher;
use App\Item;

describe('Name Is Exactly Matcher', function () {
    describe('class definition', function () {
        context('implements interface', function () {
            it('is a matcher', function() {
                $m = new NameIsExactlyMatcher('Name');
                expect($m)->toBeAnInstanceOf(Matcher::class);
            });
        });
    });
    describe('is match', function () {
        context('exact type match', function () {
            it('will match exactly', function() {
                $m = new NameIsExactlyMatcher('ABCDEFGHIJ');
                $item = new Item('ABCDEFGHIJ', 0, 0);
                expect($m->isMatch($item))->toBe(true);
            });
            it('won\'t match case-sensitivity', function() {
                $m = new NameIsExactlyMatcher('abcdefg');
                $item = new Item('ABCDEFGHIJ', 0, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('can match null', function() {
                $m = new NameIsExactlyMatcher(null);
                $item = new Item(null, 0, 0);
                expect($m->isMatch($item))->toBe(true);
            });
            it('won\'t match null to empty string', function() {
                $m = new NameIsExactlyMatcher('');
                $item = new Item(null, 0, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('won\'t match prefix', function() {
                $m = new NameIsExactlyMatcher('ABCD');
                $item = new Item('ABCDEFGHIJ', 0, 0);
                expect($m->isMatch($item))->toBe(false);
            });
            it('won\'t match suffix', function() {
                $m = new NameIsExactlyMatcher('FGHIJ');
                $item = new Item('ABCDEFGHIJ', 0, 0);
                expect($m->isMatch($item))->toBe(false);
            });
        });
    });
});
