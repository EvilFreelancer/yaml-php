<?php

namespace EvilFreelancer;

class Yaml implements YamlInterface
{
    private $_parameters = [];

    public function get(): array
    {
        return $this->_parameters;
    }

    public function set(array $parameters): Yaml
    {
        $this->_parameters = $parameters;
        return $this;
    }

    public function add(array $parameters): Yaml
    {
        $this->_parameters[] = $parameters;
        return $this;
    }

    public function save(string $filename): bool
    {
        return yaml_emit_file($filename, $this->get());
    }

    public function show(): string
    {
        return yaml_emit($this->get());
    }

    public function read(string $filename): Yaml
    {
        $this->_parameters = (filter_var($filename, FILTER_VALIDATE_URL))
            ? yaml_parse_url($filename)
            : yaml_parse_file($filename);

        return $this;
    }

    public function validate(array $values = []): Yaml
    {
        foreach ($this->get() as $p_key => $p_value) {

            if (!in_array($p_key, $values, true)) {
                throw new \Exception("Parameter \"$p_key\" not in validation array.");
            }

        }

        return $this;
    }
}
