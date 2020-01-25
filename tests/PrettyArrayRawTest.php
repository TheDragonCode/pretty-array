<?php

namespace Tests;

class PrettyArrayRawTest extends TestCase
{
    public function testAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    public function testStoreNotString()
    {
        $service = $this->service();

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('not-string.txt'),
            $formatted . PHP_EOL
        );
    }
}
