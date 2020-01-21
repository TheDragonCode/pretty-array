<?php

namespace Tests;

use Helldar\PrettyArray\Services\PrettyArray;
use PHPUnit\Framework\TestCase as TestCaseFramework;

abstract class TestCase extends TestCaseFramework
{
    protected function service(): PrettyArray
    {
        return new PrettyArray();
    }

    protected function path(string $filename, bool $is_source = true): string
    {
        $dir = $is_source ? 'files' : 'results';

        return implode(DIRECTORY_SEPARATOR, [__DIR__, $dir, $filename]);
    }

    protected function getFile(string $filename): string
    {
        return file_get_contents(
            $this->path($filename)
        );
    }

    protected function requireFile(string $filename): array
    {
        return require $this->path($filename);
    }

    protected function requireSource(): array
    {
        return $this->requireFile('source.php');
    }
}