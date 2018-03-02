<?php namespace EvilFreelancer;

/**
 * Class Yaml
 * @package EvilFreelancer
 */
class Yaml implements YamlInterface
{
    private $_parameters = [];
    private $_strict = false;

    /**
     * @param bool $strict - Enable strong check in both sides
     */
    public function __construct(bool $strict = false)
    {
        $this->_strict = $strict;
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
            $yaml = Export::save($filename, $this->show());

        } catch (\Exception $e) {
            echo "Error in " . $e->getFile() . " line " . $e->getLine() . ": " . $e->getMessage() . "\n";
            !$this->_strict ?: die();
        }

        return $yaml;
    }

    /**
     * @return string
     */
    public function show(): string
    {
        try {
            $yaml = Export::show($this->get());

        } catch (\Exception $e) {
            echo "Error in " . $e->getFile() . " line " . $e->getLine() . ": " . $e->getMessage() . "\n";
            !$this->_strict ?: die();
        }

        return $yaml;
    }

    /**
     * @param string|null $filename
     * @param string|null $data
     * @return Yaml
     */
    public function read(string $filename = null, string $data = null): Yaml
    {
        try {
            $yaml = !empty($data)
                ? Import::readFromData($data)
                : Import::readFromFile($filename);

            $this->set($yaml);

        } catch (\Exception $e) {
            echo "Error in " . $e->getFile() . " line " . $e->getLine() . ": " . $e->getMessage() . "\n";
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
        try {
            // Parse parameters in loop
            foreach ($this->get() as $p_key => $p_value) {
                // First level of keys
                if (!in_array($p_key, $values, true)) {
                    throw new \Exception("Parameter \"$p_key\" is not valid.");
                }
            }

            // If strong check is enabled
            if (true === $strong) {
                foreach ($values as $v_key) {
                    if (!in_array($v_key, array_keys($this->get()))) {
                        throw new \Exception("Parameter \"$v_key\" must be in parameters.");
                    }
                }
            }

        } catch (\Exception $e) {
            echo "Error in " . $e->getFile() . " line " . $e->getLine() . ": " . $e->getMessage() . "\n";
            !$this->_strict ?: die();
        }

        return $this;
    }
}
