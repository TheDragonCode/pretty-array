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

namespace DragonCode\PrettyArray\Exceptions;

use Exception;

class FileDoesntExistsException extends Exception
{
    public function __construct(string $filename)
    {
        $message = "File \"{$filename}\" doesn't exist";

        parent::__construct($message, 500);
    }
}
