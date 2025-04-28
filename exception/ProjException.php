<?php

use Exception;

class ProjException extends Exception
{
    private $severity;

    public function __construct(string $message, string $severity)
    {
        parent::__construct($message);
        $this->severity = $severity;
    }

    public function getSeverity(): string
    {
        return $this->severity;
    }
}
?>