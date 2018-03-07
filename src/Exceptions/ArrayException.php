<?php namespace EvilFreelancer\Yaml\Exceptions;

class FileException extends Exceptions
{
    /**
     * @param   $bool
     * @return  mixed
     * @throws  YamlException
     */
    static function fileSave($bool)
    {
        if (!$bool) {
            throw new YamlException("File could not to be saved.");
        }
        return $bool;
    }

}
