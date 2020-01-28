<?php

namespace Helldar\PrettyArray\Concerns;

use function addslashes;
use function is_array;
use function is_bool;
use function is_null;
use function is_numeric;
use function is_object;

trait HasCastable
{
    /**
     * Castable value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    protected function castValue($value = null)
    {
        if (is_numeric($value)) {
            return $value;
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_null($value)) {
            return 'null';
        }

        if (is_array($value) || is_object($value)) {
            return '[]';
        }

        return "'" . addslashes($value) . "'";
    }
}
