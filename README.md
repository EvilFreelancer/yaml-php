# YAML PHP Import/Export with validation

Small PHP library for importing and exporting with validation of YAML configuration files.

    composer require evilfreelancer/yaml-php

For correct work you need install YAML extension of PHP interpreter.

## Available methods

* `read` - Read YAML from file or URL (autodetect)
* `add` - Add without replace array of parameters
* `set` - Add with replace array of parameters
* `validate` - Check array of parameters in memory by validation template
* `get` - Return array of prepared parameters
* `save` - Export parameters in YAML format to file on filesystem
* `show` - Return YAML in plain text format

## How to use

More examples [here](extra).

### Basic example of usage

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
use \EvilFreelancer\Yaml\Yaml;

// Object for work with YAML
$yaml = new Yaml();

// Simple array from which need build YAML
$array = [
    'string' => 'zzz',
    'integer' => 42,
    'bool' => true,
];

// Generate YAML and print to stdOut
$yaml_text = $yaml->set($array)->show();
echo $yaml_text;
```

Output is:

```yaml
---
string: zzz
integer: 42
bool: true
...
```

### Read YAML from file

```php
$yaml_array = $yaml->read('example.yaml')->get();
print_r($yaml_array);
```

Output is:

```text
Array
(
    [string] => zzz
    [integer] => 42
    [bool] => 1
)
```

### How to append array

```php
$array = [
    'string' => 'zzz',
    'integer' => 42,
    'bool' => true,
];

$append = [
    'array_simple' => [
        'item1',
        'item2',
        'item3'
    ],
    'array_md' => [
        'string1' => 'text',
        'integer' => 42,
        'bool' => true
    ]
];

// Set array, then append additional array and show to stdOut
echo $yaml
    ->set($array)
    ->add($append)
    ->show();
```

Output is:

```yaml
---
string: zzz
integer: 42
bool: true
array_simple:
- item1
- item2
- item3
array_md:
  string1: text
  integer: 42
  bool: true
...
```

## How to use validation

```php
// Schema by which we need make validation
$schema = [
    'string' => Types::STRING,
    'integer' => Types::INT,
    'bool' => Types::BOOL,
    'array_simple' => Types::ARRAY,
    'array_md' => [
        'string1' => Types::STRING,
        'integer' => Types::INT,
        'bool' => Types::BOOL
    ]
];

// Array from which we need make YAML
$array = [
    'string' => 'zzz',
    'integer' => 42,
    'bool' => true,
    'array_simple' => [
        'item1',
        'item2',
        'item3'
    ],
    'array_md' => [
        'string1' => 'text',
        'integer' => 42,
        'bool' => true
    ]
];

// Set array and execute validation procedure
echo $yaml
    ->set($array)
    ->validate($schema)
    ->show();
```

In result you should saw YAML, if something wrong will be error with detailed "Stack Trace".

# Links

* [Official PHP documentation about Yaml](http://php.net/manual/ru/book.yaml.php)
* [Symfony YAML](https://github.com/symfony/yaml)
