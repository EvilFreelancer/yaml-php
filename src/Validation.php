<?php namespace EvilFreelancer\Yaml;

use EvilFreelancer\Yaml\Exceptions\ArrayException;

class Validation
{
    private $_schema = [];
    private $_strict = false;

    /**
     * Validation constructor.
     *
     * @param   bool $strict
     */
    public function __construct(bool $strict = false)
    {
        $this->_strict = $strict;
    }

    /**
     * Compare array with array's schema
     *
     * @param   array $schema - Schema with which need to compare
     * @param   array $array - Array for comparing
     */
    public function compare(array $schema, array $array)
    {
        try {
            // Check if array is associated
            ArrayException::isAssoc($schema);

        } catch (ArrayException $e) {
            !$this->_strict ?: die();
        }

        $this->_schema = $schema;
    }

    /**
     * @param   array $arr
     * @return  bool
     */
    static function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}