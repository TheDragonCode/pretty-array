<?php

namespace Helldar\PrettyArray\Contracts;

interface Caseable
{
    const CAMEL_CASE = 1;

    const KEBAB_CASE = 3;

    const NO_CASE = 0;

    const PASCAL_CASE = 4;

    const SNAKE_CASE = 2;

    public function setCase(int $type = self::NO_CASE): void;
}
