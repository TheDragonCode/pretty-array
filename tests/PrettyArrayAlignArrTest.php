<?php

namespace Tests;

use Helldar\PrettyArray\Exceptions\FileDoesntExistsException;
use Helldar\PrettyArray\Services\PrettyArrayService;
use PHPUnit\Framework\TestCase;

class PrettyArrayAlignArrTest extends TestCase
{
    protected $source = __DIR__ . DIRECTORY_SEPARATOR . 'files/source.php';

    protected $as_string = __DIR__ . DIRECTORY_SEPARATOR . 'files/arr/align-as-string.php';

    protected $not_string = __DIR__ . DIRECTORY_SEPARATOR . 'files/arr/align-not-string.php';

    /**
     * @throws FileDoesntExistsException
     */
    public function testAsString()
    {
        $service = new PrettyArrayService();
        $service->setKeyAsString();
        $service->equalsAlign();
        $service->store($this->source, $this->source . '.3.php');

        $this->assertFileEquals(
            $this->as_string,
            $this->source . '.3.php'
        );
    }

    /**
     * @throws FileDoesntExistsException
     */
    public function testNotString()
    {
        $service = new PrettyArrayService();
        $service->equalsAlign();
        $service->store($this->source, $this->source . '.4.php');

        $this->assertFileEquals(
            $this->not_string,
            $this->source . '.4.php'
        );
    }
}
