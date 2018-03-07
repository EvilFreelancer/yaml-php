<?php namespace EvilFreelancer\Yaml\Exceptions;

class Exceptions extends \Exception
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->errorLog("Uncaught Error: " . $this->getMessage() . " in " . $this->getFile() . ":" . $this->getLine());
        $this->errorLog("Stack trace:\n" . $this->getTraceAsString());
        $this->errorLog("\tthrown in " . $this->getFile() . " on line " . $this->getLine());
    }

    public function errorLog(string $error)
    {
        error_log($error);
        return false;
    }
}
