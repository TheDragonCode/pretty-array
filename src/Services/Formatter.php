<?php

namespace Helldar\PrettyArray\Services;

use Helldar\PrettyArray\Exceptions\FileDoesntExistsException;
use Helldar\Support\Facades\Arr;

use function array_keys;
use function file_exists;
use function is_array;
use function is_numeric;
use function mb_strlen;
use function str_pad;

final class Formatter
{
    protected $key_as_string = false;

    protected $equals_align = false;

    protected $pad_length = 4;

    public static function make(): self
    {
        return new static();
    }

    public function setKeyAsString(): void
    {
        $this->key_as_string = true;
    }

    public function setEqualsAlign(): void
    {
        $this->equals_align = true;
    }

    public function raw(array $array, int $pad = 1): string
    {
        $keys_size  = $this->sizeKeys($array);
        $pad_length = $this->pad_length * $pad;
        $formatted  = '[' . PHP_EOL;

        foreach ($array as $key => $value) {
            $key   = $this->key($key, $keys_size);
            $value = $this->value($value, $pad + 1);

            $row = "{$key} => {$value}," . PHP_EOL;

            $formatted .= $this->pad($row, $pad_length);
        }

        return $formatted . $this->pad(']', $pad_length - $this->pad_length);
    }

    /**
     * @param string $filename
     *
     * @return array
     * @throws FileDoesntExistsException
     */
    protected function load(string $filename): array
    {
        if (! file_exists($filename)) {
            throw new FileDoesntExistsException($filename);
        }

        return require $filename;
    }

    protected function pad(string $value, int $pad = 1, $type = STR_PAD_LEFT): string
    {
        $pad += $type === STR_PAD_LEFT
            ? mb_strlen($value)
            : 2;

        return str_pad($value, $pad, ' ', $type);
    }

    protected function value($value, int $pad = 1)
    {
        if (is_array($value)) {
            return $this->raw($value, $pad);
        }

        if (is_numeric($value)) {
            return $value;
        }

        return "'{$value}'";
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
        $sizes = Arr::sizeOfMaxValue(
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
