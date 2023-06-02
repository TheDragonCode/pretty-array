<?php

/*
 * This file is part of the "dragon-code/pretty-array" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 *
 * @copyright 2023 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/TheDragonCode/pretty-array
 */

namespace Tests;

class AlignRawTest extends TestCase
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
