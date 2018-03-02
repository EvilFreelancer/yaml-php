<?php

use EvilFreelancer\Yaml\Yaml;
use PHPUnit\Framework\TestCase;

class YamlTest extends TestCase
{
    private $yaml;

    public function __construct()
    {
        parent::__construct();

        $this->yaml = new Yaml();

        $this->array1 = [
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

        $this->array2 = [
            'zzz' => 'data'
        ];

        $this->array3 = [
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
            ],
            'zzz' => 'data'
        ];

        $this->validation1 = [
            'test',
            'head',
            'body'
        ];

        $this->validation2 = [
            'zzz'
        ];

        $this->validation3 = [
            'test',
            'head',
            'body',
            'zzz'
        ];

        $this->filename = __DIR__ . "/../extra/example.yaml";
    }

    public function testSet()
    {
        $this->yaml->set($this->array1);
        $this->assertEquals($this->array1, $this->yaml->get());
    }

    public function testAdd()
    {
        $this->yaml->set($this->array1);
        $this->yaml->add($this->array2);
        $this->assertEquals($this->array3, $this->yaml->get());
    }

    public function testSave()
    {
        $this->temp = tmpfile();
    }

    public function testShow()
    {
        $this->yaml->set($this->array1);
        $generated = $this->yaml->show();
        $fromFile = file_get_contents($this->filename);

        $this->assertEquals($generated, $fromFile);
    }

    public function testRead()
    {
        $viaClass = $this->yaml->read($this->filename)->show();
        $fromFile = file_get_contents($this->filename);

        $this->assertEquals($viaClass, $fromFile);
    }

    public function testValidate()
    {

    }
}
