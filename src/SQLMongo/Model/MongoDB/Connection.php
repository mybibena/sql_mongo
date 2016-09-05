<?php

namespace SQLMongo\Model\MongoDB;

use SQLMongo\Model\Settings;
use \MongoDB\Database;

class Connection
{
    /**
     * @var Connection|null
     */
    static private $instance = NULL;

    /**
     * @var Database|null
     */
    private $connection = NULL;

    private function __clone() {}

    private function __construct() {}

    /**
     * @static
     * @return Connection
     * @return void
     */
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    ##===========================================

    /**
     * @return Database|null
     */
    public function getConnection()
    {
        if (!is_null($this->connection)) {
            return $this->connection;
        }

        $database = $this->getDatabaseName();

        return $this->connection = (new \MongoDB\Client)->$database;
    }

    public function isCollections()
    {
        $collectionsCounter = 0;

        foreach ($this->getConnection()->listCollections() as $collection) {
            $collectionsCounter++;
        }

        return $collectionsCounter > 0;
    }

    ##===========================================

    private function getDatabaseName()
    {
        $settings = Settings::getInstance()->getSettings();

        return $settings['database']['name'];
    }
}
