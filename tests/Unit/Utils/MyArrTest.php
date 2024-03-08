<?php

declare(strict_types=1);

namespace Tests\Unit\Utils;

use App\Utils\MyArr;

test('MyArr::getString returns the default string when the key does not exist', function () {
    $arr = []; // Your test data
    $key = 'nonexistent_key';
    $default = 'default_value';

    $result = MyArr::getString($arr, $key, $default);

    expect($result)->toBe($default);
});

test('MyArr::getString returns the string value when the key exists', function () {
    $arr = ['key' => 'value']; // Your test data
    $key = 'key';
    $default = 'default_value';

    $result = MyArr::getString($arr, $key, $default);

    expect($result)->toBe('value');
});

test('MyArr::getInt returns the default integer when the key does not exist', function () {
    $arr = []; // Your test data
    $key = 'nonexistent_key';
    $default = 0;

    $result = MyArr::getInt($arr, $key, $default);

    expect($result)->toBe($default);
});

test('MyArr::getInt returns the integer value when the key exists', function () {
    $arr = ['key' => 42]; // Your test data
    $key = 'key';
    $default = 0;

    $result = MyArr::getInt($arr, $key, $default);

    expect($result)->toBe(42);
});

test('MyArr::getFloat returns the default float when the key does not exist', function () {
    $arr = []; // Your test data
    $key = 'nonexistent_key';
    $default = 0.0;

    $result = MyArr::getFloat($arr, $key, $default);

    expect($result)->toBe($default);
});

test('MyArr::getFloat returns the float value when the key exists', function () {
    $arr = ['key' => 3.14]; // Your test data
    $key = 'key';
    $default = 0.0;

    $result = MyArr::getFloat($arr, $key, $default);

    expect($result)->toBe(3.14);
});

test('MyArr::getBool returns the default boolean when the key does not exist', function () {
    $arr = []; // Your test data
    $key = 'nonexistent_key';
    $default = false;

    $result = MyArr::getBool($arr, $key, $default);

    expect($result)->toBe($default);
});

test('MyArr::getBool returns the boolean value when the key exists', function () {
    $arr = ['key' => true]; // Your test data
    $key = 'key';
    $default = false;

    $result = MyArr::getBool($arr, $key, $default);

    expect($result)->toBe(true);
});

test('MyArr::getArr returns the default array when the key does not exist', function () {
    $arr = []; // Your test data
    $key = 'nonexistent_key';
    $default = [];

    $result = MyArr::getArr($arr, $key, $default);

    expect($result)->toBe($default);
});

test('MyArr::getArr returns the array value when the key exists', function () {
    $arr = ['key' => [1, 2, 3]]; // Your test data
    $key = 'key';
    $default = [];

    $result = MyArr::getArr($arr, $key, $default);

    expect($result)->toBe([1, 2, 3]);
});
