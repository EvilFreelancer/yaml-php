<?php namespace EvilFreelancer\Yaml;

/**
 * Class Import
 * @package EvilFreelancer\Yaml
 */
class Import implements Interfaces\Import
{
    /**
     * Read YAML from file or by URL
     *
     * @param   string $filename - Name of file or url from which YAML must be taken
     * @return  mixed
     * @throws  \Exception
     */
    static public function readFromFile(string $filename)
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
     * Parce plain text with YAML inside
     *
     * @param   string $data - YAML in text format
     * @return  mixed
     * @throws  \Exception
     */
    static public function readFromData(string $data)
    {
        $yaml = yaml_parse($data);

        if (!$yaml) {
            throw new \Exception('Yaml can\'t to be parsed.');
        }

        return $yaml;
    }
}
