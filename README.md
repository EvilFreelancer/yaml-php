# YAML PHP Import/Export

Extra small PHP library for YAML configs importing and exporting.

    composer require evilfreelancer/yaml-php

For correct work you need install YAML extension of PHP interpreter.

## How to use

```php
$yaml = new \EvilFreelancer\Yaml\Yaml();

// Generate YAML and print to stdOut
$yaml_text = $yaml->set($array)->show();
echo $yaml_text;

// Read YAML from file and return array of parameters
$yaml_array = $yaml->read('example.yaml')->get();
print_r($yaml_array);
```

More examples [here](extra).

## Available methods

* `read` - Read YAML from file or URL (autodetect)
* `add` - Add without replace array of parameters
* `set` - Add with replace array of parameters
* `validate` - Check array of parameters in memory by validation template
* `get` - Return array of prepared parameters
* `save` - Export parameters in YAML format to file on filesystem
* `show` - Return YAML in plain text format

## Example with validation

```
$validation = ['test', 'head', 'body'];

// Enable validation (notice mode)
echo $yaml->read($filename)->validate($validation)->show();

$array = [
    'test' => 'asd',
    'head' => [
        'item1',
        'item2',
        'item3'
    ],
    'body' => [
        'item1',
        'item2',
        'item3'
    ]
];

// Enable validation (force stop)
echo $yaml->set($array)->add($append)->validate($validation, true)->show();
```

# Links

* [Official PHP documentation about Yaml](http://php.net/manual/ru/book.yaml.php)
* [Symfony YAML](https://github.com/symfony/yaml)