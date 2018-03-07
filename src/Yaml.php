<?php namespace EvilFreelancer\Yaml;

use EvilFreelancer\Yaml\Exceptions\YamlException;
use EvilFreelancer\Yaml\Exceptions\ArrayException;

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
     * Validate Yaml before saving
     *
     * @param   array $schema - Array of parameters which should be validated
     * @param   bool $strong - Enable strong check in two ways
     * @return  Yaml
     */
    public function validate(array $schema, bool $strong = false): Interfaces\Yaml
    {
        try {
            // Parse parameters in loop
            $keys = $this->get();

            foreach ($keys as $p_key => $p_value) {
                ArrayException::inArray($values, $p_key, 'exist');
            }

            // If strong check is enabled
            if (true === $strong) {
                $keys = array_keys($this->get());
                foreach ($values as $v_key) {
                    ArrayException::inArray($keys, $v_key, 'valid');
                }
            }

        } catch (ArrayException $e) {
            !$this->_strict ?: die();
        }

        return $this;
    }
}
