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

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Filesystem\File as Storage;
use DragonCode\Support\Facades\Tools\Stub;
use DragonCode\Support\Tools\Stub as StubTool;

/**
 * @method static File make(?string $content = null)
 */
class File
{
    use Makeable;

    public function __construct(
        protected ?string $content = null
    ) {
    }

    public function load(string $filename): array
    {
        return Storage::load($filename);
    }

    public function store(string $path, string $stub = StubTool::PHP_ARRAY): void
    {
        $content = Stub::replace($stub, [
            '{{slot}}' => $this->content,
        ]);

        Storage::store($path, $content);
    }
}
