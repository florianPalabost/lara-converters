<?php

declare(strict_types=1);

namespace App\Utils;

use ArrayAccess;
use Illuminate\Support\Arr;

class MyArr extends Arr
{
    /** Getters */
    /**
     * @param ArrayAccess<string, mixed>|array $arr
     */
    public static function getString(ArrayAccess|array $arr, string|int|null $key, string $default = ''): string
    {
        $str = parent::get($arr, $key);

        if (! is_string($str)) {
            return $default;
        }

        return $str;
    }

    /**
     * @param ArrayAccess<string, mixed>|array $arr
     */
    public static function getInt(ArrayAccess|array $arr, string|int|null $key, int $default = 0): int
    {
        $int = parent::get($arr, $key);

        if (! is_int($int)) {
            return $default;
        }

        return $int;
    }

    /**
     * @param ArrayAccess<string, mixed>|array $arr
     */
    public static function getFloat(ArrayAccess|array $arr, int|string|null $key, float $default = 0.0): float
    {
        $float = parent::get($arr, $key);

        if (! is_float($float)) {
            return $default;
        }

        return $float;
    }

    /**
     * @param ArrayAccess<string, mixed>|array $arr
     */
    public static function getBool(ArrayAccess|array $arr, string|int|null $key, bool $default = false): bool
    {
        $bool = parent::get($arr, $key);

        if (! is_bool($bool)) {
            return $default;
        }

        return $bool;
    }

    /**
     * @param ArrayAccess<string, mixed>|array $arr
     */
    public static function getArr(ArrayAccess|array $arr, string|int|null $key, array $default = []): array
    {
        $array = parent::get($arr, $key);

        if (! is_array($array)) {
            return $default;
        }

        return $array;
    }
}
