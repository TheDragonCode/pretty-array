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

class StoringText extends TestCase
{
    public function testStoring()
    {
        $service = $this->service();

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $src_file = $this->path('storing.php.txt');
        $dst_file = $this->path('stored.php');

        File::make($formatted)
            ->store($dst_file);

        $this->assertFileExists($dst_file);
        $this->assertFileEquals($src_file, $dst_file);
    }
}
