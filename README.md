# Yaml PHP

Yaml config generator written on PHP7

    composer require evilfreelancer/yaml-php

For correct work you need install Yaml extension of PHP interpreter.

## How to use

```php
$yaml = new \EvilFreelancer\Yaml();

// Generate Yaml and show on stdOut
echo $yaml
    ->set($array)
    ->show();

// Read Yaml from file and return array of parameters
$yaml_array = $yaml->read('example.yaml')->get();
print_r($yaml_array);
```

More examples [here](extra).

## Validation

```
// Enable validation (notice mode)
echo $yaml
    ->set($array)
    ->validate($validation)
    ->show();

// Enable validation (force stop)
echo $yaml
    ->set($array)
    ->validate($validation, true)
    ->show();
```

# Links

* [Official PHP documentation about Yaml](http://php.net/manual/ru/book.yaml.php)
