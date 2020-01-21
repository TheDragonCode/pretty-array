<?php

namespace Tests;

class PrettyArrayRawTest extends TestCase
{
    /**
     * @throws \Helldar\PrettyArray\Exceptions\FileDoesntExistsException
     */
    public function testAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();

        $array     = $this->requireSource();
        $formatted = $service->format($array);

        $this->assertSame(
            trim($this->getFile('raw/as-string.txt')),
            $formatted
        );
    }

    /**
     * @throws \Helldar\PrettyArray\Exceptions\FileDoesntExistsException
     */
    public function testStoreNotString()
    {
        $service = $this->service();

        $array     = $this->requireSource();
        $formatted = $service->format($array);

        $this->assertSame(
            trim($this->getFile('raw/not-string.txt')),
            $formatted
        );
    }
}
