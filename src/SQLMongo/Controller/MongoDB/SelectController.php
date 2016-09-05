<?php

namespace SQLMongo\Controller\MongoDB;

use SQLMongo\Controller\BaseController;
use SQLMongo\Model\SQLParser\SelectParser;

class SelectController extends BaseController
{
    public function process()
    {
        $parsedRequest = $this->parseRequest();

        $data = $this->prepareData($parsedRequest);

        $cursor = $this->executeMongoStatement($parsedRequest['collection'], $data);

        foreach ($cursor as $document) {
            echo json_encode($document) . "\n";
        };
    }

    ##===========================================

    /**
     * @return array
     * @throws \SQLMongo\Exception\QueryParsingException
     */
    protected function parseRequest()
    {
        $selectParser = new SelectParser();

        return $selectParser->parse($this->getInput());
    }

    /**
     * @param array $parsedRequest
     * @return array
     */
    private function prepareData($parsedRequest)
    {
        $result = [
            'filter' => [],
            'options' => [],
        ];

        if (!empty($parsedRequest['condition'])) {
            $result['filter'] = $parsedRequest['condition'];
        }

        if (!empty($parsedRequest['projections'])) {
            $result['options']['projection'] = $parsedRequest['projections'];
        }

        if (!empty($parsedRequest['order'])) {
            $result['options']['sort'] = $parsedRequest['order'];
        }

        if (!empty($parsedRequest['skip'])) {
            $result['options']['skip'] = $parsedRequest['skip'];
        }

        if (!empty($parsedRequest['limit'])) {
            $result['options']['limit'] = $parsedRequest['limit'];
        }

        return $result;
    }

    /**
     * @param string $collection
     * @param array $data
     * @return \MongoDB\Driver\Cursor
     * @throws \Exception
     */
    protected function executeMongoStatement($collection, array $data)
    {
        $connection = $this->getConnection();
        $collection = $connection->$collection;

        $filter = $data['filter'];
        $options = $data['options'];

        return $collection->find($filter, $options);
    }
}