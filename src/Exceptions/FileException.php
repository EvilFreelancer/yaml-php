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

    /**
     * @param $bool
     * @return mixed
     * @throws YamlException
     */
    static function yamlExport($bool)
    {
        if (!$bool) {
            throw new YamlException('YAML can\'t to be emitted from current array.');
        }
        return $bool;
    }

    /**
     * @param $bool
     * @return mixed
     * @throws YamlException
     */
    static function yamlImportFromFile($bool)
    {
        if (!$bool) {
            throw new YamlException('Yaml can\'t to be parsed from source.');
        }
        return $bool;
    }

    /**
     * @param $bool
     * @return mixed
     * @throws YamlException
     */
    static function yamlImportFromData($bool)
    {
        if (!$bool) {
            throw new YamlException('Yaml can\'t to be parsed.');
        }
        return $bool;
    }


}
