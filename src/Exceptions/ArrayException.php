<?php namespace EvilFreelancer\Yaml\Exceptions;

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

}
