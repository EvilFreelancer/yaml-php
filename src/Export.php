<?php namespace EvilFreelancer\Yaml;

use EvilFreelancer\Yaml\Exceptions\YamlException;

/**
 * Class Export
 * @package EvilFreelancer\Yaml
 */
class Export implements Interfaces\Export
{
    /**
     * Write data to file
     *
     * @param   object $fileObject
     * @param   string $data
     * @return  bool|int
     * @throws  YamlException
     */
    static public function save(object $fileObject, string $data)
    {
        $write = $fileObject->fwrite($data);
        YamlException::export($write);
        return $write;
    }

    /**
     * Returns a YAML encoded string on success.
     *
     * @param   array $array
     * @return  string
     * @throws  YamlException
     */
    static public function show(array $array): string
    {
        $yaml = yaml_emit($array);
        YamlException::export($yaml);
        return $yaml;
    }
}
