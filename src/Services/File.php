<?php

namespace Helldar\PrettyArray\Services;

use Helldar\PrettyArray\Exceptions\FileDoesntExistsException;
use Helldar\Support\Facades\File as FileSupport;
use Helldar\Support\Facades\Str;
use Helldar\Support\Tools\Stub;

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

        return $this->isJson($filename)
            ? $this->loadJson($filename)
            : require $filename;
    }

    public function loadJson(string $filename)
    {
        return json_decode(file_get_contents($filename), true);
    }

    public function store(string $path)
    {
        $content = Stub::replace(Stub::CONFIG_FILE, [
            '{{slot}}' => $this->content,
        ]);

        FileSupport::store($path, $content);
    }

    public function isJson(string $filename): bool
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        return Str::lower($extension) === 'json';
    }
}
