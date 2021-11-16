<?php

namespace Tests;

use DragonCode\PrettyArray\Services\File;

class FormatterStoringText extends TestCase
{
    public function testStoring()
    {
        $service = $this->service();

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $src_file = $this->path('storing.php.txt');
        $dst_file = $this->path('stored.php');

        File::make($formatted)
            ->store($dst_file);

        $this->assertFileExists($dst_file);
        $this->assertFileEquals($src_file, $dst_file);
    }
}
