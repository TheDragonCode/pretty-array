<?php

namespace Tests;

class FormatterSimple extends TestCase
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
