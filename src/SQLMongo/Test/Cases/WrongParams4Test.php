<?php

namespace SQLMongo\Test\Cases;

class WrongParams4Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Query parsing error: Invalid sorting direction
     */
    public function test() {
        $query = "SELECT * FROM zips WHERE city = 'CHICAGO' ORDER BY pop INVLD";

        $sqlMongo = new \SQLMongo\SQLMongo;
        $sqlMongo->init();

        $sqlMongo->execute($query);
    }
}
?>
