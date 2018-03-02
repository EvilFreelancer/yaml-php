<?php namespace EvilFreelancer;

/**
 * Class Export
 * @package EvilFreelancer
 */
class Export
{
    /**
     * @param string $filename
     * @param string $data
     * @param bool $tmp
     * @return bool|int
     * @throws \Exception
     */
    static function save(string $filename, string $data, bool $tmp = false)
    {
        $fp = $tmp
            ? fopen($filename, "w")
            : tmpfile();

        if (!$fp) {
            throw new \Exception('File open failed.');
        }

        $fw = fwrite($fp, $data);

        if (!$fw) {
            throw new \Exception("File $filename could not to be saved.");
        }

        fclose($fp);

        return $fw;
    }

    /**
     * @param array $array
     * @return string
     * @throws \Exception
     */
    static function show(array $array): string
    {
        $yaml = yaml_emit($array);

        if (!$yaml) {
            throw new \Exception('Yaml can\'t to be emitted from current array.');
        }

        return $yaml;
    }
}
