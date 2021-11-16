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

namespace DragonCode\PrettyArray\Services;

use DragonCode\PrettyArray\Exceptions\FileDoesntExistsException;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Filesystem\File as FileSupport;
use DragonCode\Support\Facades\Tools\Stub;
use DragonCode\Support\Tools\Stub as StubTool;

/**
 * @method static \DragonCode\PrettyArray\Services\File make(string $content = null)
 */
class File
{
    use Makeable;

    protected $content;

    public function __construct(string $content = null)
    {
        $this->content = $content;
    }

    /**
     * @param  string  $filename
     *
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     *
     * @return mixed
     */
    public function load(string $filename)
    {
        if (! file_exists($filename)) {
            throw new FileDoesntExistsException($filename);
        }

        return require $filename;
    }

    public function loadRaw(string $filename)
    {
        return file_get_contents($filename);
    }

    public function store(string $path, string $stub = StubTool::PHP_ARRAY): void
    {
        $content = Stub::replace($stub, [
            '{{slot}}' => $this->content,
        ]);

        FileSupport::store($path, $content);
    }

    public function storeRaw(string $path): void
    {
        FileSupport::store($path, $this->content);
    }
}
