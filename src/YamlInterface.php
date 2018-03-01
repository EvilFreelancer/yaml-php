<?php namespace EvilFreelancer;

/**
 * Interface YamlInterface
 * @package EvilFreelancer
 */
interface YamlInterface
{
    /**
     * Get all stored variables
     *
     * @return  array - Converted to array Yaml
     */
    public function get(): array;

    /**
     * Read Yaml from file
     *
     * @param   string|null $filename - File or URL with Yaml inside
     * @param   string|null $data - Plain Yaml
     * @return  Yaml
     */
    public function read(string $filename = null, string $data = null): Yaml;

    /**
     * Save Yaml to file
     *
     * @param   string $filename
     * @return  bool
     */
    public function save(string $filename): bool;

    /**
     * Return ready for usage generated Yaml
     *
     * @return  string
     */
    public function show(): string;

    /**
     * Add Yaml (overwrite if already defined) parameters
     *
     * @param   array $parameters - Array required for Yaml generating
     * @return  Yaml
     */
    public function set(array $parameters): Yaml;

    /**
     * Add Yaml parameters
     *
     * @param   array $parameters - Array required for Yaml generating
     * @return  Yaml
     */
    public function add(array $parameters): Yaml;

    /**
     * Validate Yaml before saving
     *
     * @param   array $values - Array of parameters which should be validated
     * @param   bool $strong - Enable strong check in two ways
     * @return  Yaml
     * @throws  \Exception
     */
    public function validate(array $values): Yaml;
}
