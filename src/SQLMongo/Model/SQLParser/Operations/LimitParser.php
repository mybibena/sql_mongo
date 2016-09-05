<?php

namespace SQLMongo\Model\SQLParser\Operations;

use SQLMongo\Exception\QueryParsingException;
use SQLMongo\Model\SQLParser\BaseParser;

class LimitParser extends BaseParser
{
    /**
     * @param array $expression
     * @return int
     * @throws QueryParsingException
     */
    public function parse($expression)
    {
        if (count($expression) != 1) {
            throw new QueryParsingException('Invalid LIMIT expression');
        }

        $expression = array_shift($expression);

        if (!is_numeric($expression) || $expression != (int)$expression) {
            throw new QueryParsingException('LIMIT must be integer');
        }

        return (int)$expression;
    }
}