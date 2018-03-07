<?php namespace EvilFreelancer\Yaml;

use EvilFreelancer\Yaml\Exceptions\YamlException;
use EvilFreelancer\Yaml\Exceptions\ArrayException;
use EvilFreelancer\Yaml\Exceptions\TypeException;
use EvilFreelancer\Yaml\Validation;

/**
 * Class Yaml
 * @package EvilFreelancer\Yaml
 */
class Yaml implements Interfaces\Yaml
{
    /**
     * Array with all parameters of YAML
     * @var array
     */
    private $_parameters = [];

    /**
     * Enable or disable strong check mode
     * @var bool
     */
    private $_strict = false;

    /**
     * @param bool $strict - Enable strong check in both sides
     */
    public function __construct(bool $strict = false)
    {
        $this->_strict = $strict;
    }

    /**
     * Get all stored variables
     *
     * @return  array - Converted to array Yaml
     */
    public function get(): array
    {
        return $this->_parameters;
    }

    /**
     * Add Yaml (overwrite if already defined) parameters
     *
     * @param   array $parameters - Array required for Yaml generating
     * @return  Interfaces\Yaml
     */
    public function set(array $parameters): Interfaces\Yaml
    {
        $this->_parameters = $parameters;
        return $this;
    }

    /**
     * Add Yaml parameters
     *
     * @param   array $parameters - Array required for Yaml generating
     * @return  Interfaces\Yaml
     */
    public function add(array $parameters): Interfaces\Yaml
    {
        $this->_parameters += $parameters;
        return $this;
    }

    /**
     * Save Yaml to file
     *
     * @param   string $filename - Name of file
     * @param   bool $debug - Save file to tmp or as normal file
     * @return  bool
     */
    public function save(string $filename, bool $debug = false): bool
    {
        $yaml = false;
        try {
            $fileObject = !$debug
                ? new \SplFileObject($filename, 'w')
                : new \SplTempFileObject();

            $yaml = Export::save($fileObject, $this->show());

        } catch (YamlException $e) {
            !$this->_strict ?: die();
        }

        return $yaml;
    }

    /**
     * Return ready for usage generated Yaml
     *
     * @return  string
     */
    public function show(): string
    {
        $yaml = false;
        try {
            $yaml = Export::show($this->get());

        } catch (YamlException $e) {
            !$this->_strict ?: die();
        }

        return $yaml;
    }

    /**
     * Read Yaml from file
     *
     * @param   string|null $filename - File or URL with Yaml inside
     * @param   string|null $data - Plain Yaml
     * @return  Yaml
     */
    public function read(string $filename = null, string $data = null): Interfaces\Yaml
    {
        try {
            $yaml = !empty($data)
                ? Import::fromData($data)
                : Import::fromFile($filename);

            $this->set($yaml);

        } catch (YamlException $e) {
            !$this->_strict ?: die();
        }

        return $this;
    }

    /**
     * Compare current parameters with required schema
     *
     * @param   array $parameters
     * @param   array $schema
     * @param   string|null $parent_key
     */
    private function parse(array $parameters, array $schema, string $parent_key = null)
    {
        array_map(
            function ($key, $value) use ($schema, $parent_key) {
                // If key found in schema
                if (array_key_exists($key, $schema)) {

                    // If we have two arrays, then run recursive analyze
                    if (is_array($value) && is_array($schema[$key])) {
                        $this->parse($value, $schema[$key], $key);
                    } else {
                        // Make method from variable
                        $method = 'is_' . $schema[$key];

                        try {
                            // Check for exception
                            TypeException::wrongType($method, $key, $value, $schema[$key], $parent_key);
                        } catch (TypeException $e) {
                            !$this->_strict ?: die();
                        }
                    }

                }
            },
            array_keys($parameters),
            $parameters
        );
    }

    /**
     * Validate Yaml before saving
     *
     * @param   array $schema - Array of parameters which should be validated
     * @param   bool $strong - Enable strong check in two ways
     * @return  Yaml
     */
    public function validate(array $schema, bool $strong = false): Interfaces\Yaml
    {
        $valid = new Validation();
        $valid->compare($schema, $this->_parameters);

        // Parse parameters in loop
        $parameters = $this->get();

        // Parse two arrays and compare data
        $this->parse($parameters, $schema);

        return $this;
    }
}
