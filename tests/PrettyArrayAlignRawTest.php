<?php

namespace Tests;

class PrettyArrayAlignRawTest extends TestCase
{
    public function testAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setEqualsAlign();

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('align-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    public function testStoreNotString()
    {
        $service = $this->service();
        $service->setEqualsAlign();

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('align-not-string.txt'),
            $formatted . PHP_EOL
        );
    }
}
