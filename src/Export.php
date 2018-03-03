<?php namespace EvilFreelancer\Yaml;

/**
 * Class Export
 * @package EvilFreelancer\Yaml
 */
class Export implements Interfaces\Export
{
    /**
     * @param object $fileObject
     * @param string $data
     * @return bool|int
     * @throws \Exception
     */
    static public function save(object $fileObject, string $data)
    {
        $write = $fileObject->fwrite($data);

        if (!$write) {
            throw new \Exception("File could not to be saved.");
        }

        return $write;
    }

    /**
     * @param array $array
     * @return string
     * @throws \Exception
     */
    static public function show(array $array): string
    {
        $yaml = yaml_emit($array);

        if (!$yaml) {
            throw new \Exception('YAML can\'t to be emitted from current array.');
        }

        return $yaml;
    }
}
