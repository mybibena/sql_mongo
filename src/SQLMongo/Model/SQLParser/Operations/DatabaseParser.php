<?php

namespace SQLMongo\Model\SQLParser\Operations;

use SQLMongo\Exception\QueryParsingException;
use SQLMongo\Model\SQLParser\BaseParser;

class DatabaseParser extends BaseParser
{
    /**
     * @param array $expression
     * @return string
     * @throws QueryParsingException
     */
    public function parse($expression)
    {
        if (count($expression) != 1) {
            throw new QueryParsingException('Invalid FROM expression');
        }

        $database = array_shift($expression);
        $database = trim($database, '`');

        return $database;
    }
}