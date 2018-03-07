<?php namespace EvilFreelancer\Yaml\Exceptions;

use Throwable;

class YamlException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errorLog("Error in " . $this->getFile() . " line " . $this->getLine() . ": " . $this->getMessage() . "\n");
    }

    public function errorLog(string $error)
    {
        error_log($error);
        return false;
    }
}
