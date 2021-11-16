<?php

namespace Tests;

use DragonCode\PrettyArray\Services\File;

class FormatterStoringCustomStubText extends TestCase
{
    public function testStoring()
    {
        $service = $this->service();

        $service->setKeyAsString();
        $service->setEqualsAlign();

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $src_file = $this->path('custom-array.txt');
        $dst_file = $this->path('stored.php');

        $stub = __DIR__ . '/stubs/custom.txt';

        File::make($formatted)
            ->store($dst_file, $stub);

        $this->assertFileExists($dst_file);
        $this->assertFileEquals($src_file, $dst_file);
    }
}
