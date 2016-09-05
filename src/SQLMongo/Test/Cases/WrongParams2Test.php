<?php

namespace SQLMongo\Test\Cases;

class WrongParams2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage This operation will be implemented in next version
     */
    public function test() {
        $query = "INSERT INTO zips data";

        $sqlMongo = new \SQLMongo\SQLMongo;
        $sqlMongo->init();

        $sqlMongo->execute($query);
    }
}
?>
