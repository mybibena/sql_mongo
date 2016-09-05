<?php

namespace SQLMongo\Model\SQLParser\Operations;

use SQLMongo\Exception\QueryParsingException;
use SQLMongo\Model\SQLParser\BaseParser;

class GroupParser extends BaseParser
{
    /**
     * @param array $expression
     * @throws QueryParsingException
     * @return array
     */
    public function parse($expression)
    {
        throw new QueryParsingException('GROUP BY expression will be implemented in next version');
    }
}