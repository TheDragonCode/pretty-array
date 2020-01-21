<?php

namespace Tests;

class PrettyArrayArrTest extends TestCase
{
    public function testAsString()
    {
        $filename = 'arr-as-string.1.php';

        $service = $this->service();
        $service->setKeyAsString();

        $service->store(
            $this->path($filename, false),
            $this->requireSource()
        );

        $this->assertFileEquals(
            $this->path('arr/as-string.php'),
            $this->path($filename, false)
        );
    }

    public function testNotString()
    {
        $filename = 'arr-not-string.2.php';

        $service = $this->service();

        $service->store(
            $this->path($filename, false),
            $this->requireSource()
        );

        $this->assertFileEquals(
            $this->path('arr/not-string.php'),
            $this->path($filename, false)
        );
    }
}
