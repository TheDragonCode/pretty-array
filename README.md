# Pretty Array

Simple conversion of an array to a pretty view.

![pretty-array](https://user-images.githubusercontent.com/10347617/73126548-1e703a00-3fc5-11ea-8b49-c2101031bdc8.png)

<p align="center">
    <a href="https://packagist.org/packages/andrey-helldar/pretty-array"><img src="https://img.shields.io/packagist/dt/andrey-helldar/pretty-array.svg?style=flat-square" alt="Total Downloads" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/pretty-array"><img src="https://poser.pugx.org/andrey-helldar/pretty-array/v/stable?format=flat-square" alt="Latest Stable Version" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/pretty-array"><img src="https://poser.pugx.org/andrey-helldar/pretty-array/v/unstable?format=flat-square" alt="Latest Unstable Version" /></a>
</p>

<p align="center">
    <a href="https://styleci.io/repos/219764491"><img src="https://styleci.io/repos/219764491/shield" alt="StyleCI" /></a>
    <a href="https://travis-ci.org/andrey-helldar/pretty-array"><img src="https://travis-ci.org/andrey-helldar/pretty-array.svg?branch=master" alt="Travis-CI" /></a>
    <a href="LICENSE"><img src="https://poser.pugx.org/andrey-helldar/pretty-array/license?format=flat-square" alt="License" /></a>
</p>


## Installation

To get the latest version of `Pretty Array` package, simply require the project using [Composer](https://getcomposer.org):

```
composer require andrey-helldar/pretty-array --dev
```

Instead, you may of course manually update your `require-dev` block and run `composer update` if you so choose:

```json
{
    "require-dev": {
        "andrey-helldar/pretty-array": "^2.2"
    }
}
```

## Introduction

> Q: Why did you create this package when there is a cooler [symfony/var-exporter](https://github.com/symfony/var-exporter)?

The big minus of package [symfony/var-exporter](https://github.com/symfony/var-exporter) is that it works differently with numeric keys.

For example, we have an array:

```php
$array = [
    100 => 'foo',
    200 => 'bar',
    201 => 'baz',
    202 => 'qwe',
    205 => 'ert',
    206 => 'tyu'
];
```

When exporting through it, the file will contain the following content:

```php
$array = [
    100 => 'foo',
    200 => 'bar',
    'baz',
    'qwe',
    205 => 'ert',
    'tyu'
];
```

> Q: Why do you think this is bad?

This package has a framework-independent base. However, it was originally developed as an assistant for
package [lang-translations](https://github.com/andrey-helldar/lang-translations).

This package allows you to publish language translations for the Laravel framework.

A feature of the framework is that IDEs that help with development do not know how to read the numeric keys of arrays of translation files, so it was necessary to translate them
into a text equivalent.

This behavior includes [errors.php](https://github.com/andrey-helldar/lang-translations/blob/master/src/lang/en/errors.php) file:

```php
<?php

return [
    'unknownError' => 'Unknown Error',
    '0' => 'Unknown Error',

    '100' => 'Continue',
    '101' => 'Switching Protocols',
    '102' => 'Processing',

    '200' => 'OK',
    '201' => 'Created',
    '202' => 'Accepted',
    '203' => 'Non-Authoritative Information',
    '204' => 'No Content',
    '205' => 'Reset Content',
    '206' => 'Partial Content',
    '207' => 'Multi-Status',
    '208' => 'Already Reported',
    '226' => 'IM Used',

// ...
```

The peculiarity of the package is that it takes the values of the source file and combines it with what is already in the application. Thus, the output is a file with numeric keys
that IDE helpers cannot read:

```php
<?php

return [
    'unknownError' => 'Unknown Error',
    0 => 'Unknown Error',

    100 => 'Continue',
    'Switching Protocols',
    'Processing',

    200 => 'OK',
    '201' => 'Created',
    'Accepted',
    'Non-Authoritative Information',
    'No Content',
    'Reset Content',
    'Partial Content',
    'Multi-Status',
    'Already Reported',
    226 => 'IM Used',

// ...
```

## Using

Source array for all examples:

```php
$array = array (
    'foo' => 1,
    'bar' => 2,
    'baz' => 3,
    'qwerty' => 'qaz',
    'baq' => array (
        0 => 'qwe',
        '1' => 'rty',
        'asd' => 'zxc',
    ),
    'asdfgh' => array (
        'foobarbaz' => 'qwe',
        2 => 'rty',
        'qawsed' => 'zxc',
    ),
    2 => 'iop',
);
```

### Saving numeric keys without alignment

```php
use Helldar\PrettyArray\Services\Formatter;

$service = Formatter::make();

return $service->raw($array);
```

Result:

```text
[
    'foo' => 1,
    'bar' => 2,
    'baz' => 3,
    'qwerty' => 'qaz',
    'baq' => [
        0 => 'qwe',
        1 => 'rty',
        'asd' => 'zxc',
    ],
    'asdfgh' => [
        'foobarbaz' => 'qwe',
        2 => 'rty',
        'qawsed' => 'zxc',
    ],
    2 => 'iop',
]
```

### Saving string keys without alignment

```php
use Helldar\PrettyArray\Services\Formatter;

$service = Formatter::make();
$service->setKeyAsString();

return $service->raw($array);
```

Result:

```text
[
    'foo' => 1,
    'bar' => 2,
    'baz' => 3,
    'qwerty' => 'qaz',
    'baq' => [
        '0' => 'qwe',
        '1' => 'rty',
        'asd' => 'zxc',
    ],
    'asdfgh' => [
        'foobarbaz' => 'qwe',
        '2' => 'rty',
        'qawsed' => 'zxc',
    ],
    '2' => 'iop',
]
```

### Saving numeric keys with alignment

```php
use Helldar\PrettyArray\Services\Formatter;

$service = Formatter::make();
$service->setEqualsAlign();

return $service->raw($array);
```

Result:

```text
[
    'foo'    => 1,
    'bar'    => 2,
    'baz'    => 3,
    'qwerty' => 'qaz',
    'baq'    => [
        0     => 'qwe',
        1     => 'rty',
        'asd' => 'zxc',
    ],
    'asdfgh' => [
        'foobarbaz' => 'qwe',
        2           => 'rty',
        'qawsed'    => 'zxc',
    ],
    2        => 'iop',
]
```

### Saving string keys with alignment

```php
use Helldar\PrettyArray\Services\Formatter;

$service = Formatter::make();
$service->setKeyAsString();
$service->setEqualsAlign();

return $service->raw($array);
```

Result:

```text
[
    'foo'    => 1,
    'bar'    => 2,
    'baz'    => 3,
    'qwerty' => 'qaz',
    'baq'    => [
        '0'   => 'qwe',
        '1'   => 'rty',
        'asd' => 'zxc',
    ],
    'asdfgh' => [
        'foobarbaz' => 'qwe',
        '2'         => 'rty',
        'qawsed'    => 'zxc',
    ],
    '2'      => 'iop',
]
```

### Saving simple array

```php
use Helldar\PrettyArray\Services\Formatter;

$service = Formatter::make();
$service->setSimple();

return $service->raw($array);
```

Result:

```text
[
    1,
    2,
    3,
    'qaz',
    [
        'qwe',
        'rty',
        'zxc',
    ],
    [
        'qwe',
        'rty',
        'zxc',
    ],
    'iop',
]
```

### Change key case

```php
use Helldar\PrettyArray\Contracts\Caseable;
use Helldar\PrettyArray\Services\Formatter;

$service = Formatter::make();
$service->setCase(Caseable::PASCAL_CASE);

return $service->raw($array);
```

Result:

```text
[
    'Foo' => 1,
    'Bar' => 2,
    'Baz' => 3,
    'QweRty' => 'qaz',
    'Baq' => [
        0 => 'qwe',
        1 => 'rty',
        'Asd' => 'zxc',
    ],
    'AsdFgh' => [
        'FooBarBaz' => 'qwe',
        2 => 'rty',
        'QawSed' => 'zxc',
    ],
    2 => 'iop',
]
```

The following options are available:

* camelCase (`Helldar\PrettyArray\Contracts\Caseable::CAMEL_CASE`);
* kebab-case (`Helldar\PrettyArray\Contracts\Caseable::KEBAB_CASE`);
* PascalCase (`Helldar\PrettyArray\Contracts\Caseable::PASCAL_CASE`);
* snake_case (`Helldar\PrettyArray\Contracts\Caseable::SNAKE_CASE`);
* no case (`Helldar\PrettyArray\Contracts\Caseable::NO_CASE`). By default;

`NO_CASE` means that key register processing will not be performed.


### Storing file

```php
use Helldar\PrettyArray\Services\File;
use Helldar\PrettyArray\Services\Formatter;

$service = Formatter::make();

$formatted = $service->raw($array);

File::make($formatted)
    ->store('foo.php');
```

Result in stored file `foo.php`:

```php
<?php

return [
    'foo' => 1,
    'bar' => 2,
    'baz' => 3,
    'qwerty' => 'qaz',
    'baq' => [
        0 => 'qwe',
        1 => 'rty',
        'asd' => 'zxc',
    ],
    'asdfgh' => [
        'foobarbaz' => 'qwe',
        2 => 'rty',
        'qawsed' => 'zxc',
    ],
    2 => 'iop',
];
```

## License

This package is licensed under the [MIT License](LICENSE).


## For Enterprise

Available as part of the Tidelift Subscription.

The maintainers of `andrey-helldar/pretty-array` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source packages you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact packages you use. [Learn more](https://tidelift.com/subscription/pkg/packagist-andrey-helldar-pretty-array?utm_source=packagist-andrey-helldar-pretty-array&utm_medium=referral&utm_campaign=enterprise&utm_term=repo).
