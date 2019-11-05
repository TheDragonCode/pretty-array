<?php

namespace Tests\Services;

use Helldar\PrettyArray\Exceptions\FileDoesntExistsException;
use Helldar\PrettyArray\Services\PrettyArrayService;
use PHPUnit\Framework\TestCase;

class PrettyArrayArrTest extends TestCase
{
    protected $source = __DIR__ . DIRECTORY_SEPARATOR . 'files/source.php';

    protected $as_string = __DIR__ . DIRECTORY_SEPARATOR . 'files/arr/as-string.php';

    protected $not_string = __DIR__ . DIRECTORY_SEPARATOR . 'files/arr/not-string.php';

    /**
     * @throws FileDoesntExistsException
     */
    public function testAsString()
    {
        $service = new PrettyArrayService();
        $service->setKeyAsString();
        $service->store($this->source, $this->source . '.1.php');

        $this->assertFileEquals(
            $this->as_string,
            $this->source . '.1.php'
        );
    }

    /**
     * @throws FileDoesntExistsException
     */
    public function testNotString()
    {
        $service = new PrettyArrayService();
        $service->store($this->source, $this->source . '.2.php');

        $this->assertFileEquals(
            $this->not_string,
            $this->source . '.2.php'
        );
    }
}
