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

trait HasCastable
{
    /**
     * Castable value.
     *
     * @param  mixed  $value
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
