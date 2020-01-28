<?php

namespace Helldar\PrettyArray\Concerns;

use function addslashes;
use function is_bool;
use function is_numeric;
use function is_null;

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

        return "'" . addslashes($value) . "'";
    }
}
