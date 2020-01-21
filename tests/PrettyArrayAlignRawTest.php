<?php

namespace Tests;

use Helldar\PrettyArray\Exceptions\FileDoesntExistsException;
use Helldar\PrettyArray\Services\PrettyArray;
use PHPUnit\Framework\TestCase;

class PrettyArrayAlignRawTest extends TestCase
{
    protected $source = __DIR__ . DIRECTORY_SEPARATOR . 'files/source.php';

    protected $as_string = __DIR__ . DIRECTORY_SEPARATOR . 'files/raw/as-string.txt';

    protected $not_string = __DIR__ . DIRECTORY_SEPARATOR . 'files/raw/not-string.txt';

    /**
     * @throws FileDoesntExistsException
     */
    public function testAsString()
    {
        $service = new PrettyArray();
        $service->setKeyAsString();
        $service->setEqualsAlign();

        $content = $service->raw($this->source);

        $this->assertEquals(
            trim(file_get_contents($this->as_string)),
            $content
        );
    }

    /**
     * @throws FileDoesntExistsException
     */
    public function testStoreNotString()
    {
        $service = new PrettyArray();
        $service->setEqualsAlign();

        $content = $service->raw($this->source);

        $this->assertEquals(
            trim(file_get_contents($this->not_string)),
            $content
        );
    }
}
