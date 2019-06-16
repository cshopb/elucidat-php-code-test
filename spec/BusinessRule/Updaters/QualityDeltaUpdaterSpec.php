<?php

use App\BusinessRule\Updater;
use App\BusinessRule\Updaters\QualityDeltaUpdater;
use App\Item;

describe('Quality Delta Updater', function () {
    describe('class definition', function () {
        context('implements interface', function () {
            it('is an updater', function() {
                $u = new QualityDeltaUpdater(1);
                expect($u)->toBeAnInstanceOf(Updater::class);
            });
        });
    });
    describe('update', function () {
        context('assigns parameter value', function () {
            it('assigns positive value', function () {
                $u = new QualityDeltaUpdater(1);
                $item = new Item('Name', 5, 0);
                $u->update($item);
                expect($item->quality)->toBe(6);
            });
            it('assigns negative value', function () {
                $u = new QualityDeltaUpdater(-1);
                $item = new Item('Name', 5, 0);
                $u->update($item);
                expect($item->quality)->toBe(4);
            });
            it('assigns zero', function () {
                $u = new QualityDeltaUpdater(0);
                $item = new Item('Name', 5, 0);
                $u->update($item);
                expect($item->quality)->toBe(5);
            });
        });
    });
});
