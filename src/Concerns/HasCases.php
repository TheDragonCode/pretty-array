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

namespace DragonCode\PrettyArray\Concerns;

use DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException;
use DragonCode\Support\Facades\Helpers\Str;

trait HasCases
{
    protected $case = self::NO_CASE;

    /**
     * @param  int  $type
     *
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function setCase(int $type = self::NO_CASE): void
    {
        if ($type < 0 || $type > 4) {
            throw new UnknownCaseTypeException($type);
        }

        $this->case = $type;
    }

    protected function convertKeysCase(array $array): array
    {
        if ($this->case === static::NO_CASE) {
            return $array;
        }

        $result = [];

        foreach ($array as $key => $value) {
            $key = $this->convertKeyCase($key);

            $result[$key] = $value;
        }

        return $result;
    }

    protected function convertKeyCase($key)
    {
        if (! is_string($key)) {
            return $key;
        }

        switch ($this->case) {
            case static::KEBAB_CASE:
                return $this->caseTo(
                    $this->caseTo($key, static::PASCAL_CASE),
                    static::KEBAB_CASE
                );
            case static::CAMEL_CASE:
                return $this->caseTo(
                    $this->caseTo($key, static::KEBAB_CASE),
                    static::CAMEL_CASE
                );
            case static::SNAKE_CASE:
                return $this->caseTo(
                    $this->caseTo($key, static::PASCAL_CASE),
                    static::SNAKE_CASE
                );
            case static::PASCAL_CASE:
                return $this->caseTo(
                    $this->caseTo($key, static::KEBAB_CASE),
                    static::PASCAL_CASE
                );
            default:
                return $key;
        }
    }

    protected function caseTo($key, int $case = 0)
    {
        if (! is_string($key)) {
            return $key;
        }

        switch ($case) {
            case static::CAMEL_CASE:
                return Str::camel($key);
            case static::KEBAB_CASE:
                return Str::snake($key, '-');
            case static::SNAKE_CASE:
                return Str::snake($key);
            case static::PASCAL_CASE:
                return Str::studly($key);
            default:
                return $key;
        }
    }
}
