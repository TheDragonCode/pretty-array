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

use DragonCode\PrettyArray\Services\File;

class StoringCustomStubText extends TestCase
{
    public function testStoring()
    {
        $service = $this->service();

        $service->setKeyAsString();
        $service->setEqualsAlign();

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $src_file = $this->path('custom-array.txt');
        $dst_file = $this->path('stored.php');

        $stub = __DIR__ . '/stubs/custom.txt';

        File::make($formatted)
            ->store($dst_file, $stub);

        $this->assertFileExists($dst_file);
        $this->assertFileEquals($src_file, $dst_file);
    }
}
