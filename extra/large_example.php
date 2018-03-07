<?php
require_once __DIR__ . '/../vendor/autoload.php';

use \EvilFreelancer\Yaml\Yaml;
use \EvilFreelancer\Yaml\Types;

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

$yaml = new Yaml();

// Read array from variable and show
echo $yaml
    ->set($array)
    ->show();

// Read array from variable, make validation and show
echo $yaml
    ->set($array)
    ->validate($schema)
    ->show();

// Read array from variable, make validation and save to file
echo $yaml
    ->set($array)
    ->validate($schema, true)
    ->save('test.yaml', true);

// Read file and save
$out = $yaml
    ->read('example.yaml')
    ->get();

print_r($out);
