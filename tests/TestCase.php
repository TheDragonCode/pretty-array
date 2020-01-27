<?php

namespace Tests;

use Helldar\PrettyArray\Services\File;
use Helldar\PrettyArray\Services\Formatter;
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
     * @param string $filename
     *
     * @return array
     * @throws \Helldar\PrettyArray\Exceptions\FileDoesntExistsException
     */
    protected function requireFile(string $filename): array
    {
        return File::make()->load(
            $this->path($filename)
        );
    }

    /**
     * @return array
     * @throws \Helldar\PrettyArray\Exceptions\FileDoesntExistsException
     */
    protected function requireSource(): array
    {
        return $this->requireFile('source.php');
    }
}
