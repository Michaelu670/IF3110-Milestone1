<?php

class LoggedException extends Exception
{
    public function __construct($message = '', $code=0)
    {
        parent::__construct($message, $code);
        $this->printError($message, $code);
    }

    private function printError($message, $code)
    {
        error_log('[ERROR]' . $code . ': ' . $message);
    }
}