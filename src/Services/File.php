<?php

namespace Helldar\PrettyArray\Services;

use Helldar\Support\Facades\File as FileSupport;
use Helldar\Support\Tools\Stub;

class File
{
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public static function make(string $content)
    {
        return new static($content);
    }

    public function store(string $path)
    {
        $content = Stub::replace(Stub::CONFIG_FILE, [
            '{{slot}}' => $this->content,
        ]);

        FileSupport::store($path, $content);
    }
}
