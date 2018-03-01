<?php namespace EvilFreelancer;

class YamlExceptions
{
    private $_strict;

    public function __construct(bool $strict = false)
    {
        $this->_strict = $strict;
    }

    public function arrayKey(string $key, array $array, string $type)
    {
        try {
            if (!in_array($key, $array, true)) {
                throw new \Exception("Parameter \"$key\" not in $type array.");
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            !$this->_strict ?: die();
        }
    }

    public function arrayEmpty(array $array)
    {
        try {
            if (empty($array)) {
                throw new \Exception('Array is empty.');
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            !$this->_strict ?: die();
        }
    }
}
