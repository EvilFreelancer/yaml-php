<?php namespace EvilFreelancer\Yaml\Exceptions;

class TypeException extends Exceptions
{
    /**
     * @param $method
     * @param string $key
     * @param mixed $have
     * @param string $should
     * @param string $parent_key
     * @return bool
     * @throws TypeException
     */
    static function wrongType($method, string $key, $have, string $should, string $parent_key = null): bool
    {
        $key = !empty($parent_key) ? $parent_key . '[' . $key . ']' : $key;
        if (!$method($have)) {
            throw new TypeException($key . ': "' . gettype($have) . '" is incorrect type should be "' . $should . '"');
        }
        return false;
    }

}
