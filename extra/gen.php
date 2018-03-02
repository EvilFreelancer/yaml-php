<?php
require_once __DIR__ . '/../vendor/autoload.php';

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

$validation = [
    'test',
    'head',
    'body'
];

$yaml = new \EvilFreelancer\Yaml\Yaml();

echo $yaml
    ->set($array)
    ->validate($validation, true)
    ->show();

$out = $yaml->read('example.yaml')->get();
print_r($out);
