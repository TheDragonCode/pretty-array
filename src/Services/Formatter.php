<?php

/*
 * This file is part of the "dragon-code/pretty-array" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 *
 * @copyright 2021 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/TheDragonCode/pretty-array
 */

namespace DragonCode\PrettyArray\Services;

use DragonCode\Contracts\Pretty\Arr\Caseable;
use DragonCode\PrettyArray\Concerns\HasCases;
use DragonCode\PrettyArray\Concerns\HasCastable;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Arr;

class Formatter implements Caseable
{
    use HasCases;
    use HasCastable;
    use Makeable;

    protected $key_as_string = false;

    protected $equals_align = false;

    protected $is_simple = false;

    protected $pad_length = 4;

    protected $line_break = PHP_EOL;

    public function setKeyAsString(): void
    {
        $this->key_as_string = true;
    }

    public function setEqualsAlign(): void
    {
        $this->equals_align = true;
    }

    public function setSimple(): void
    {
        $this->is_simple = true;
    }

    public function raw(array $array, int $pad = 1): string
    {
        if (empty($array)) {
            return '[]';
        }

        $array = $this->convertKeysCase($array);

        $keys_size  = $this->sizeKeys($array);
        $pad_length = $this->pad_length * $pad;
        $formatted  = '[' . $this->line_break;

        foreach ($array as $key => $value) {
            $key   = $this->key($key, $keys_size);
            $value = $this->value($value, $pad + 1);

            $row = $this->is_simple
                ? "$value," . $this->line_break
                : "$key => $value," . $this->line_break;

            $formatted .= $this->pad($row, $pad_length);
        }

        return $formatted . $this->pad(']', $pad_length - $this->pad_length);
    }

    protected function pad(string $value, int $pad = 1, $type = STR_PAD_LEFT): string
    {
        $pad += $type === STR_PAD_LEFT
            ? strlen($value)
            : 2;

        return str_pad($value, $pad, ' ', $type);
    }

    protected function value($value, int $pad = 1)
    {
        if (! empty($value) && (is_array($value) || is_object($value))) {
            return $this->raw($value, $pad);
        }

        return $this->castValue($value);
    }

    protected function key($key, int $size = 0)
    {
        $key = $this->isStringKey($key) ? "'{$key}'" : $key;

        if (! $this->equals_align) {
            return $key;
        }

        return $this->pad($key, $this->keySizeCollision($key, $size), STR_PAD_RIGHT);
    }

    protected function sizeKeys(array $array): int
    {
        $sizes = Arr::longestStringLength(
            array_keys($array)
        );

        return $this->key_as_string
            ? $sizes + 2
            : $sizes;
    }

    protected function keySizeCollision($key, int $size): int
    {
        $collision = is_numeric($key)
            ? 0
            : ($this->isAlignAndString() ? -2 : 0);

        return $size + $collision;
    }

    protected function isStringKey($key): bool
    {
        return $this->key_as_string || ! is_numeric($key);
    }

    protected function isAlignAndString(): bool
    {
        return $this->equals_align && $this->key_as_string;
    }
}
