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

final class PrettyArrayService
{
    private $key_as_string = false;

    private $equals_align = false;

    private $pad_length = 4;

    public function setKeyAsString(): void
    {
        $this->key_as_string = true;
    }

    public function equalsAlign(): void
    {
        $this->equals_align = true;
    }

    /**
     * @param string $filename
     *
     * @throws FileDoesntExistsException
     *
     * @return string
     */
    final public function getRaw(string $filename): string
    {
        $array = $this->load($filename);

        return $this->format($array);
    }

    /**
     * @param string $filename
     * @param string|null $target_filename
     *
     * @throws FileDoesntExistsException
     */
    final public function store(string $filename, string $target_filename = null)
    {
        $content = $this->getRaw($filename);

        file_put_contents(
            $target_filename ?: $filename,
            '<?php' . PHP_EOL . PHP_EOL . 'return ' . $content . ';' . PHP_EOL
        );
    }

    /**
     * @param string $filename
     *
     * @throws FileDoesntExistsException
     *
     * @return array
     */
    final private function load(string $filename): array
    {
        if (! file_exists($filename)) {
            throw new FileDoesntExistsException($filename);
        }

        return require $filename;
    }

    final private function format(array $array, int $pad = 1): string
    {
        $keys_size  = $this->sizeKeys($array);
        $pad_length = $this->pad_length * $pad;
        $formatted  = '[' . PHP_EOL;

        foreach ($array as $key => $value) {
            $key   = $this->key($key, $keys_size + ($pad * 2));
            $value = $this->value($value, $pad + 1);

            $row = "{$key}=> {$value}," . PHP_EOL;

            $formatted .= $this->pad($pad_length, $row);
        }

        $formatted .= $this->pad($pad_length - 6, ']');

        return $formatted;
    }

    final private function pad(int $pad_length = 0, string $value = '', $type = STR_PAD_LEFT): string
    {
        $pad_length += $type === STR_PAD_LEFT
            ? mb_strlen(trim($value)) + 2
            : 0;

        return str_pad($value, $pad_length, ' ', $type);
    }

    final private function value($value, int $pad = 0)
    {
        if (is_array($value)) {
            return $this->format($value, $pad);
        }

        if (is_numeric($value)) {
            return $value;
        }

        return "'{$value}'";
    }

    final private function key($value, int $keys_size = 0)
    {
        $value = ! $this->key_as_string && is_numeric($value)
            ? $value
            : "'{$value}'";

        if (! $this->equals_align) {
            return $value;
        }

        return $this->pad($keys_size + $this->pad_length - 2, $value, STR_PAD_RIGHT);
    }

    final private function sizeKeys(array $array): int
    {
        $keys = array_map(function ($key) {
            return (string) $key;
        }, array_keys($array));

        return Arr::sizeOfMaxValue($keys);
    }
}
