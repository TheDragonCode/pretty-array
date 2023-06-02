<?php

/*
 * This file is part of the "dragon-code/pretty-array" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 *
 * @copyright 2023 Andrey Helldar
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

    protected bool $key_as_string = false;

    protected bool $equals_align = false;

    protected bool $is_simple = false;

    protected int $pad_length = 4;

    protected string $line_break = PHP_EOL;

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

        $formatted = '[' . $this->line_break;

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
        $pad += $type === STR_PAD_LEFT ? strlen($value) : 2;

        return str_pad($value, $pad, ' ', $type);
    }

    protected function value($value, int $pad = 1): mixed
    {
        if (! empty($value) && (is_array($value) || is_object($value))) {
            return $this->raw($value, $pad);
        }

        return $this->castValue($value);
    }

    protected function key(mixed $key, int $size = 0): string
    {
        $key = $this->isStringKey($key) ? "'{$key}'" : $key;

        if (! $this->equals_align) {
            return $key;
        }

        return $this->pad($key, $this->keySizeCollision($key, $size), STR_PAD_RIGHT);
    }

    protected function sizeKeys(array $array): int
    {
        $sizes = Arr::of($array)->keys()->longestStringLength();

        return $this->key_as_string ? $sizes + 2 : $sizes;
    }

    protected function keySizeCollision($key, int $size): int
    {
        $collision = is_numeric($key) ? 0 : ($this->isAlignAndString() ? -2 : 0);

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
