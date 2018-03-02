<?php namespace EvilFreelancer;

/**
 * Class Import
 * @package EvilFreelancer
 */
class Import
{
    /**
     * @param string $filename
     * @return mixed
     * @throws \Exception
     */
    static function readFromFile(string $filename)
    {
        $yaml = filter_var($filename, FILTER_VALIDATE_URL)
            ? yaml_parse_url($filename)
            : yaml_parse_file($filename);

        if (!$yaml) {
            throw new \Exception('Yaml can\'t to be parsed from source.');
        }

        return $yaml;
    }

    /**
     * @param string $data
     * @return mixed
     * @throws \Exception
     */
    static function readFromData(string $data)
    {
        $yaml = yaml_parse($data);

        if (!$yaml) {
            throw new \Exception('Yaml can\'t to be parsed.');
        }

        return $yaml;
    }
}
