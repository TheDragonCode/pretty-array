<?php

namespace Helldar\PrettyArray\Concerns;

use Helldar\PrettyArray\Exceptions\UnknownCaseTypeException;
use Helldar\Support\Facades\Str;

trait HasCases
{
    protected $case = self::NO_CASE;

    /**
     * @param int $type
     *
     * @throws \Helldar\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function setCase(int $type = self::NO_CASE): void
    {
        if ($type < 0 || $type > 4) {
            throw new UnknownCaseTypeException($type);
        }

        $this->case = $type;
    }

    protected function convertKeysCase(array &$array): void
    {
        if ($this->case === static::NO_CASE) {
            return;
        }

        $result = [];

        foreach ($array as $key => $item) {
            $key = $this->convertKeyCase($key);

            $result[$key] = $value;
        }

        $array = $result;
    }

    protected function convertKeyCase($key)
    {
        if (! is_string($key)) {
            return $key;
        }

        switch ($this->case) {
            case static::CAMEL_CASE:
                return Str::camel($key);
            case static::SNAKE_CASE:
                return Str::snake($key);
            case static::KEBAB_CASE:
                return Str::snake($key, '-');
            case static::PASCAL_CASE:
                return Str::studly($key);
            default:
                return $key;
        }
    }
}
