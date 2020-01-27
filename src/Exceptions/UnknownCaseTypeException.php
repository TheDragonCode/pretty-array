<?php

namespace Helldar\PrettyArray\Exceptions;

class UnknownCaseTypeException extends \Exception
{
    public function __construct(string $type)
    {
        parent::__construct("Unknown conversion type: {$type}", 500);
    }
}
