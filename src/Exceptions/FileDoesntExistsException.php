<?php

namespace Helldar\PrettyArray\Exceptions;

use Exception;

class FileDoesntExistsException extends Exception
{
    public function __construct(string $filename)
    {
        $message = "File \"{$filename}\" doesn't exist";

        parent::__construct($message, 500);
    }
}
