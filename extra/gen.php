<?php
require_once __DIR__ . '/../vendor/autoload.php';
use \EvilFreelancer\Yaml\Types;

$array = [
    'test' => 'asd',
    'head' => [
        'item1',
        'item2',
        'item3'
    ],
    'body' => [
        'string' => 'text',
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
        'string' => Types::STRING,
        'integer' => Types::INT,
        'bool' => Types::BOOL
    ]
];

$yaml = new \EvilFreelancer\Yaml\Yaml();
$validation = new \EvilFreelancer\Yaml\Yaml();

echo $yaml->set($array)->validate($schema, true)->show();

//echo $yaml
//    ->set($array)
//    ->validate($validation_schema, true)
//    ->save('test.yaml', true);

$out = $yaml->read('example.yaml')->get();
print_r($out);
