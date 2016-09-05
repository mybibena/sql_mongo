<?php

namespace SQLMongo\Controller;

use SQLMongo\Model\MongoDB\Connection;

abstract class BaseController
{
    /**
     * @var string|null
     */
    private $input = NULL;

    public function __construct($input)
    {
        $this->setInput($input);
    }

    /**
     * @param string $input
     */
    private function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * @return null|string
     */
    protected function getInput()
    {
        return $this->input;
    }

    ##===========================================

    abstract public function process();

    /**
     * @return mixed
     */
    abstract protected function parseRequest();

    /**
     * @param string $collection
     * @param array $data
     * @return mixed
     */
    abstract protected function executeMongoStatement($collection, array $data);

    ##===========================================

    protected function getConnection()
    {
        $connectionModel = Connection::getInstance();

        if (!$connectionModel->isCollections()) {
            throw new \Exception("Selected mongo database is empty\n");
        }

        return $connectionModel->getConnection();
    }
}