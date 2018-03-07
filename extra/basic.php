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
