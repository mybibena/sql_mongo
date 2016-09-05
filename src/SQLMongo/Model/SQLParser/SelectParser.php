<?php

namespace SQLMongo\Model\SQLParser;

use SQLMongo\Exception\QueryParsingException;
use SQLMongo\Model\SQLParser\Operations\FieldParser;
use SQLMongo\Model\SQLParser\Operations\DatabaseParser;
use SQLMongo\Model\SQLParser\Operations\ConditionParser;
use SQLMongo\Model\SQLParser\Operations\GroupParser;
use SQLMongo\Model\SQLParser\Operations\SortParser;
use SQLMongo\Model\SQLParser\Operations\SkipParser;
use SQLMongo\Model\SQLParser\Operations\LimitParser;

class SelectParser extends BaseParser
{
    const SELECT_OPERATOR = 'SELECT';
    const FROM_OPERATOR = 'FROM';
    const WHERE_OPERATOR = 'WHERE';
    const GROUP_OPERATOR = 'GROUP';
    const ORDER_OPERATOR = 'ORDER';
    const SKIP_OPERATOR = 'SKIP';
    const LIMIT_OPERATOR = 'LIMIT';

    /**
     * @param string $query
     * @return array
     * @throws QueryParsingException
     */
    public function parse($query)
    {
        $result = [];

        $splitedQuery = $this->splitQuery($query);
        $groupedQuery = $this->groupQuery($splitedQuery);

        if (empty($groupedQuery)) {
            throw new QueryParsingException("Can't parse request");
        }

        foreach ($groupedQuery as $operation => $data) {
            switch ($operation) {
                case self::SELECT_OPERATOR:
                    $parser = new FieldParser();
                    $result['projections'] = $parser->parse($data);
                    break;
                case self::FROM_OPERATOR:
                    $parser = new DatabaseParser();
                    $result['collection'] = $parser->parse($data);
                    break;
                case self::WHERE_OPERATOR:
                    $parser = new ConditionParser();
                    $result['condition'] = $parser->parse($data);
                    break;
                case self::GROUP_OPERATOR:
                    $parser = new GroupParser();
                    $result['group'] = $parser->parse($data);
                    break;
                case self::ORDER_OPERATOR:
                    $parser = new SortParser();
                    $result['order'] = $parser->parse($data);
                    break;
                case self::SKIP_OPERATOR:
                    $parser = new SkipParser();
                    $result['skip'] = $parser->parse($data);
                    break;
                case self::LIMIT_OPERATOR:
                    $parser = new LimitParser();
                    $result['limit'] = $parser->parse($data);
                    break;
            }
        }

        if (empty($result['collection'])) {
            throw new QueryParsingException('Missing collection name');
        }

        return $result;
    }

    /**
     * @param string $query
     * @return array
     */
    private function splitQuery($query)
    {
        return preg_split('#[\s;]#m', $query, NULL, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * @param array $splitedQuery
     * @return array
     */
    private function groupQuery(array $splitedQuery)
    {
        $currentBlock = NULL;
        $result = [];

        foreach ($splitedQuery as $block) {
            if (in_array($block, $this->getAvailableGroups())) {
                $currentBlock = $block;
                continue;
            }

            if (empty($currentBlock)) {
                continue;
            }

            $result[$currentBlock][] = trim($block, ",`\t\n\r\0\x0B");
        }

        return $result;
    }

    private function getAvailableGroups()
    {
        return [
            self::SELECT_OPERATOR,
            self::FROM_OPERATOR,
            self::WHERE_OPERATOR,
            self::GROUP_OPERATOR,
            self::ORDER_OPERATOR,
            self::SKIP_OPERATOR,
            self::LIMIT_OPERATOR,
        ];
    }
}