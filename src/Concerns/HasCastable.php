<?php

namespace Helldar\PrettyArray\Concerns;

use function addslashes;
use function is_bool;
use function is_numeric;

trait HasCastable
{
    /**
     * Castable value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    protected function castValue($value)
    {
        if (is_numeric($value)) {
            return $value;
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return "'" . addslashes($value) . "'";
    }
}
