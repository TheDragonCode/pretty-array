<?php

namespace Helldar\PrettyArray\Services;

use function max;
use function mb_strlen;

final class Arr
{
    /**
     * Get the size of the longest text element of the array.
     *
     * @param array $array
     *
     * @return int
     */
    final public static function sizeOfMaxValue(array $array): int
    {
        return mb_strlen(max($array), 'UTF-8');
    }
}
