<?php namespace EvilFreelancer\Yaml;

class Validation
{
    /**
     * @param array $arr
     * @return bool
     */
    static function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}