<?php namespace EvilFreelancer\Yaml\Interfaces;

/**
 * Interface Export
 * @package EvilFreelancer\Yaml\Interfaces
 */
interface Export
{
    /**
     * Save Yaml to file
     *
     * @param   object $fileObject - Object of file
     * @param   string $data - Text for writing
     * @return  bool|int
     * @throws  \Exception
     */
    static public function save(object $fileObject, string $data);

    /**
     * Return generated YAML
     *
     * @param   array $array
     * @return  string
     * @throws  \Exception
     */
    static public function show(array $array): string;
}
