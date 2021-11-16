<?php

/*
 * This file is part of the "dragon-code/pretty-array" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 *
 * @copyright 2021 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/TheDragonCode/pretty-array
 */

namespace Tests;

class FormatterSimpleTest extends TestCase
{
    public function testAsSimple()
    {
        $service = $this->service();
        $service->setSimple();

        $array     = $this->requireSource('source-simple.php');
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('simple.txt'),
            $formatted . PHP_EOL
        );
    }
}
