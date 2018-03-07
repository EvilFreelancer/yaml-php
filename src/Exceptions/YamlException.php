<?php namespace EvilFreelancer\Yaml\Exceptions;

class YamlException extends Exceptions
{
    /**
     * @param $bool
     * @return mixed
     * @throws YamlException
     */
    static function export($bool)
    {
        if (!$bool) {
            throw new YamlException('YAML can\'t to be emitted from current array');
        }
        return $bool;
    }

    /**
     * @param $bool
     * @return mixed
     * @throws YamlException
     */
    static function importFromFile($bool)
    {
        if (!$bool) {
            throw new YamlException('Yaml can\'t to be parsed from source');
        }
        return $bool;
    }

    /**
     * @param $bool
     * @return mixed
     * @throws YamlException
     */
    static function importFromData($bool)
    {
        if (!$bool) {
            throw new YamlException('Yaml can\'t to be parsed');
        }
        return $bool;
    }


}
