<?php namespace EvilFreelancer\Yaml;

use EvilFreelancer\Yaml\Exceptions\YamlException;

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
     * @throws  YamlException
     */
    static public function fromFile(string $filename)
    {
        $yaml = filter_var($filename, FILTER_VALIDATE_URL)
            ? yaml_parse_url($filename)
            : yaml_parse_file($filename);

        YamlException::importFromFile($yaml);
        return $yaml;
    }

    /**
     * Parce plain text with YAML inside
     *
     * @param   string $data - YAML in text format
     * @return  mixed
     * @throws  YamlException
     */
    static public function fromData(string $data)
    {
        $yaml = yaml_parse($data);
        YamlException::importFromData($yaml);
        return $yaml;
    }
}
