<?php

namespace Helldar\PrettyArray\Services;

use Helldar\PrettyArray\Exceptions\FileDoesntExistsException;

use function array_keys;
use function file_exists;
use function is_array;
use function is_numeric;
use function mb_strlen;
use function str_pad;
use function trim;

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

    public function store(string $filename, array $array)
    {
        $content = $this->format($array);

        file_put_contents(
            $filename,
            '<?php' . PHP_EOL . PHP_EOL . 'return ' . $content . ';' . PHP_EOL
        );
    }

    public function format(array $array, int $pad = 1): string
    {
        $keys_size  = $this->sizeKeys($array);
        $pad_length = $this->pad_length * $pad;
        $formatted  = '[' . PHP_EOL;

        foreach ($array as $key => $value) {
            $key   = $this->key($key, $keys_size + ($pad * 2));
            $value = $this->value($value, $pad + 1);

            $row = "{$key} => {$value}," . PHP_EOL;

            $formatted .= $this->pad($pad_length, $row, $key);
        }

        $formatted .= $this->pad($pad_length - 6, ']');

        return $formatted;
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

    protected function pad(int $pad_length = 0, string $value = '', $key = null, $type = STR_PAD_LEFT): string
    {
        $collision = $this->equals_align && is_numeric($key)
            ? 0 : -2;

        $pad_length += $type === STR_PAD_LEFT
            ? mb_strlen(trim($value)) + 2
            : $collision;

        return str_pad($value, $pad_length, ' ', $type);
    }

    protected function value($value, int $pad = 0)
    {
        if (is_array($value)) {
            return $this->format($value, $pad);
        }

        if (is_numeric($value)) {
            return $value;
        }

        return "'{$value}'";
    }

    protected function key($value, int $keys_size = 0)
    {
        $value = ! $this->key_as_string && is_numeric($value)
            ? $value
            : "'{$value}'";

        if (! $this->equals_align) {
            return $value;
        }

        return $this->pad(
            $keys_size + $this->pad_length - 2,
            $value,
            null,
            STR_PAD_RIGHT);
    }

    protected function sizeKeys(array $array): int
    {
        $keys = array_map(function ($key) {
            return (string) $key;
        }, array_keys($array));

        return Arr::sizeOfMaxValue($keys);
    }
}
