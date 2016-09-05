<?php

namespace SQLMongo\Model\SQLParser\Operations;

use SQLMongo\Exception\QueryParsingException;
use SQLMongo\Model\SQLParser\BaseParser;

class FieldParser extends BaseParser
{
    /**
     * @param array $expression
     * @throws QueryParsingException
     * @return array
     */
    public function parse($expression)
    {
        $result = [];

        if (count($expression) < 1) {
            throw new QueryParsingException('Invalid fields list');
        }

        if (in_array('*', $expression)) {
            if (count($expression) > 1) {
                throw new QueryParsingException('Invalid fields list');
            } elseif (count($expression) == 1) {
                return [];
            }
        }

        if (!in_array('id', $expression) && !in_array('_id', $expression)) {
            $result['_id'] = false;
        }

        foreach ($expression as $field) {
            $field = trim($field, '*,`');

            $result[$field] = true;
        }

        return $result;
    }
}