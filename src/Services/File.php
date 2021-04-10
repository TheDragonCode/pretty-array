<?php

namespace Helldar\PrettyArray\Services;

use Helldar\PrettyArray\Exceptions\FileDoesntExistsException;
use Helldar\Support\Facades\Helpers\Filesystem\File as FileSupport;
use Helldar\Support\Facades\Tools\Stub;
use Helldar\Support\Tools\Stub as StubTool;

class File
{
    protected $content;

    public function __construct(string $content = null)
    {
        $this->content = $content;
    }

    public static function make(string $content = null)
    {
        return new static($content);
    }

    /**
     * @param  string  $filename
     *
     * @throws \Helldar\PrettyArray\Exceptions\FileDoesntExistsException
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
