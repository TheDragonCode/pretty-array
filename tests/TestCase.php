<?php

namespace Tests;

use DragonCode\PrettyArray\Services\File;
use DragonCode\PrettyArray\Services\Formatter;
use PHPUnit\Framework\TestCase as TestCaseFramework;

abstract class TestCase extends TestCaseFramework
{
    protected function service(): Formatter
    {
        return Formatter::make();
    }

    protected function path(string $filename): string
    {
        return implode(DIRECTORY_SEPARATOR, [__DIR__, 'stubs', $filename]);
    }

    protected function getFile(string $filename): string
    {
        return file_get_contents(
            $this->path($filename)
        );
    }

    /**
     * @param  string  $filename
     *
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     *
     * @return array
     */
    protected function requireFile(string $filename): array
    {
        return File::make()->load(
            $this->path($filename)
        );
    }

    /**
     * @param  string  $filename
     *
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     *
     * @return array
     */
    protected function requireSource(string $filename = 'source.php'): array
    {
        return $this->requireFile($filename);
    }
}
