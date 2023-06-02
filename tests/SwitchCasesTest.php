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

use DragonCode\Contracts\Pretty\Arr\Caseable;

class SwitchCasesTest extends TestCase
{
    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testCamelAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setCase(Caseable::CAMEL_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-camel-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testCamelNotString()
    {
        $service = $this->service();
        $service->setCase(Caseable::CAMEL_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-camel-not-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testCamelAlignAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setEqualsAlign();
        $service->setCase(Caseable::CAMEL_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-camel-align-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testCamelAlignNotString()
    {
        $service = $this->service();
        $service->setEqualsAlign();
        $service->setCase(Caseable::CAMEL_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-camel-align-not-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testKebabAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setCase(Caseable::KEBAB_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-kebab-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testKebabNotString()
    {
        $service = $this->service();
        $service->setCase(Caseable::KEBAB_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-kebab-not-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testKebabAlignAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setEqualsAlign();
        $service->setCase(Caseable::KEBAB_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-kebab-align-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testKebabAlignNotString()
    {
        $service = $this->service();
        $service->setEqualsAlign();
        $service->setCase(Caseable::KEBAB_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-kebab-align-not-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testPascalAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setCase(Caseable::PASCAL_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-pascal-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testPascalNotString()
    {
        $service = $this->service();
        $service->setCase(Caseable::PASCAL_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-pascal-not-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testPascalAlignAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setEqualsAlign();
        $service->setCase(Caseable::PASCAL_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-pascal-align-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testPascalAlignNotString()
    {
        $service = $this->service();
        $service->setEqualsAlign();
        $service->setCase(Caseable::PASCAL_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-pascal-align-not-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testSnakeAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setCase(Caseable::SNAKE_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-snake-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testSnakeNotString()
    {
        $service = $this->service();
        $service->setCase(Caseable::SNAKE_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-snake-not-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testSnakeAlignAsString()
    {
        $service = $this->service();
        $service->setKeyAsString();
        $service->setEqualsAlign();
        $service->setCase(Caseable::SNAKE_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-snake-align-as-string.txt'),
            $formatted . PHP_EOL
        );
    }

    /**
     * @throws \DragonCode\PrettyArray\Exceptions\FileDoesntExistsException
     * @throws \DragonCode\PrettyArray\Exceptions\UnknownCaseTypeException
     */
    public function testSnakeAlignNotString()
    {
        $service = $this->service();
        $service->setEqualsAlign();
        $service->setCase(Caseable::SNAKE_CASE);

        $array     = $this->requireSource();
        $formatted = $service->raw($array);

        $this->assertSame(
            $this->getFile('case-snake-align-not-string.txt'),
            $formatted . PHP_EOL
        );
    }
}
