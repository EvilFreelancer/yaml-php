<?php namespace EvilFreelancer\Yaml\Exceptions;

use EvilFreelancer\Yaml\Validation;

class ArrayException extends Exceptions
{
    /**
     * @param   array $array
     * @param   string $key
     * @param   string $message - Additional message of string
     * @return  bool
     * @throws  ArrayException
     */
    static function inArray(array $array, string $key, string $message = 'exist'): bool
    {
        if (!in_array($key, $array)) {
            throw new ArrayException("Parameter \"$key\" is not $message");
        }
        return true;
    }

    /**
     * @param array $array
     * @return bool
     * @throws ArrayException
     */
    static function isArray(array $array)
    {
        if (!is_array($array)) {
            throw new ArrayException("Value is not array");
        }
        return true;
    }

    /**
     * @param   array $array
     * @return  bool
     * @throws  ArrayException
     */
    static function isAssoc(array $array): bool
    {
        if (!Validation::isAssoc($array)) {
            throw new ArrayException("Array is not associated");
        }
        return true;
    }

}
