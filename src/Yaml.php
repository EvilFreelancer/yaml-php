<?php

namespace EvilFreelancer;

class Yaml implements YamlInterface
{
    private $_parameters = [];
    private $_strict = false;
    private $_exceptions;

    /**
     * @param bool $strict - Enable strong check in both sides
     */
    public function __construct(bool $strict = false)
    {
        $this->_strict = $strict;
        $this->_exceptions = new YamlExceptions($strict);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->_parameters;
    }

    /**
     * @param array $parameters
     * @return Yaml
     */
    public function set(array $parameters): Yaml
    {
        $this->_parameters = $parameters;
        return $this;
    }

    /**
     * @param array $parameters
     * @return Yaml
     */
    public function add(array $parameters): Yaml
    {
        $this->_parameters = array_merge($this->_parameters, $parameters);
        return $this;
    }

    /**
     * @param string $filename
     * @return bool
     */
    public function save(string $filename): bool
    {
        try {
            $yaml = yaml_emit_file($filename, $this->get());
            if (!$yaml) {
                throw new \Exception("File $filename could not to be saved.");
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            !$this->_strict ?: die();
        }

        return $yaml;
    }

    /**
     * @return string
     */
    public function show(): string
    {
        return yaml_emit($this->get());
    }

    /**
     * @param string|null $filename
     * @param string|null $data
     * @return Yaml
     */
    public function read(string $filename = null, string $data = null): Yaml
    {
        try {
            if (!empty($data)) {
                $yaml = yaml_parse($data);
                if (!$yaml) {
                    throw new \Exception('Yaml can\'t to be parsed.');
                }
            } else {
                $yaml = filter_var($filename, FILTER_VALIDATE_URL)
                    ? yaml_parse_url($filename)
                    : yaml_parse_file($filename);

                if (!$yaml) {
                    throw new \Exception('Yaml can\'t to be parsed from source.');
                }
            }

            $this->set($yaml);

        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            !$this->_strict ?: die();
        }

        return $this;
    }

    /**
     * @param array $values
     * @param bool $strong
     * @return Yaml
     */
    public function validate(array $values, bool $strong = false): Yaml
    {
        // Check for empty array
        $this->_exceptions->arrayEmpty($values);

        // Parse parameters in loop
        foreach ($this->get() as $p_key => $p_value) {
            // First level of keys
            $this->_exceptions->arrayKey($p_key, $values, 'parameters');
        }

        // If strong check is enabled
        if (true === $strong) {
            foreach ($values as $v_key) {
                $this->_exceptions->arrayKey($v_key, array_keys($this->get()), 'validation');
            }
        }

        return $this;
    }
}
