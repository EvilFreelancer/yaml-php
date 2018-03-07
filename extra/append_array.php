<?php
require_once __DIR__ . '/../vendor/autoload.php';
use \EvilFreelancer\Yaml\Yaml;

// Object for work with YAML
$yaml = new Yaml();

// Original array
$array = [
    'string' => 'zzz',
    'integer' => 42,
    'bool' => true,
];

// Array which should be appended
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

// Print result to stdOut
echo $yaml
    ->set($array)
    ->add($append)
    ->show();
