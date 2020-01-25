<?php

namespace Helldar\PrettyArray\Services;

use Helldar\PrettyArray\Exceptions\FileDoesntExistsException;
use Helldar\Support\Facades\File as FileSupport;
use Helldar\Support\Tools\Stub;

class File
{
    protected $content;

    public function __construct(string $content = null)
    {
        $this->content = $content;
    }

    public static function make(string $content)
    {
        return new static($content);
    }

    /**
     * @param string $filename
     *
     * @return array
     * @throws \Helldar\PrettyArray\Exceptions\FileDoesntExistsException
     */
    public function load(string $filename): array
    {
        if (! file_exists($filename)) {
            throw new FileDoesntExistsException($filename);
        }

        return require $filename;
    }

    public function store(string $path)
    {
        $content = Stub::replace(Stub::CONFIG_FILE, [
            '{{slot}}' => $this->content,
        ]);

        FileSupport::store($path, $content);
    }
}
