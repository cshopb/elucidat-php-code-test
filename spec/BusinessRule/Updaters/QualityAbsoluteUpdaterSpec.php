<?php

use App\BusinessRule\Updater;
use App\BusinessRule\Updaters\QualityAbsoluteUpdater;
use App\Item;

describe('Quality Absolute Updater', function () {
    describe('class definition', function () {
        context('implements interface', function () {
            it('is an updater', function() {
                $u = new QualityAbsoluteUpdater(1);
                expect($u)->toBeAnInstanceOf(Updater::class);
            });
        });
    });
    describe('update', function () {
        context('assigns parameter value', function () {
            it('assigns positive value', function () {
                $u = new QualityAbsoluteUpdater(1);
                $item = new Item('Name', 5, 0);
                $u->update($item);
                expect($item->quality)->toBe(1);
            });
            it('assigns negative value', function () {
                $u = new QualityAbsoluteUpdater(-1);
                $item = new Item('Name', 5, 0);
                $u->update($item);
                expect($item->quality)->toBe(-1);
            });
            it('assigns zero', function () {
                $u = new QualityAbsoluteUpdater(0);
                $item = new Item('Name', 5, 0);
                $u->update($item);
                expect($item->quality)->toBe(0);
            });
            it('doesn\'t fail when values are the same', function () {
                $u = new QualityAbsoluteUpdater(0);
                $item = new Item('Name', 0, 5);
                $u->update($item);
                expect($item->quality)->toBe(0);
            });
        });
    });
});
