<?php

namespace SQLMongo\Model\SQLParser\Operations;

use SQLMongo\Exception\QueryParsingException;
use SQLMongo\Model\SQLParser\BaseParser;

class SortParser extends BaseParser
{
    /**
     * @param array $expression
     * @return array
     * @throws QueryParsingException
     */
    public function parse($expression)
    {
        if (count($expression) != 3) {
            throw new QueryParsingException('Invalid ORDER BY expression');
        }

        $orderField = $expression[1];
        $orderDirection = $expression[2];

        if (!in_array($orderDirection, ['ASC', 'DESC'])) {
            throw new QueryParsingException('Invalid sorting direction');
        }

        return [
            $orderField => ($orderDirection == 'ASC' ? 1 : -1),
        ];
    }
}