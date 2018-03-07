<?php namespace EvilFreelancer\Yaml\Exceptions;

class FileException extends Exceptions
{
    /**
     * @param   $bool
     * @return  mixed
     * @throws  FileException
     */
    static function fileSave($bool)
    {
        if (!$bool) {
            throw new FileException("File could not to be saved");
        }
        return $bool;
    }

}
