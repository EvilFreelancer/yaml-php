<?php namespace EvilFreelancer\Yaml\Interfaces;

/**
 * Interface Export
 * @package EvilFreelancer\Yaml\Interfaces
 */
interface Import
{
    /**
     * Read YAML from file or by URL
     *
     * @param   string $filename - Name of file or url from which YAML must be taken
     * @return  mixed
     * @throws  \Exception
     */
    static public function fromFile(string $filename);

    /**
     * Parce plain text with YAML inside
     *
     * @param   string $data - YAML in text format
     * @return  mixed
     * @throws  \Exception
     */
    static public function fromData(string $data);
}
