<?php

namespace SQLMongo\Exception;

class QueryParsingException extends \Exception
{
    public function __construct($message)
    {
        $message = "Query parsing error: {$message}\n";

        parent::__construct($message);
    }
}