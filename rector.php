<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/database',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->skip([
        SimplifyBoolIdenticalTrueRector::class,
        __DIR__ . '/vendor',
    ]);

    $rectorConfig->sets([
        SetList::PHP_82,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::CODE_QUALITY,
        \RectorLaravel\Set\LaravelSetList::LARAVEL_100,
    ]);
};
