<?php
require_once __DIR__ . '/../vendor/autoload.php';
use \EvilFreelancer\Yaml\Yaml;

// Object for work with YAML
$yaml = new Yaml();

// Read YAML from file
$yaml_array = $yaml->read('example.yaml')->get();
print_r($yaml_array);
