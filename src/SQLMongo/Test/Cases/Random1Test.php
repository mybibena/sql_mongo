<?php

namespace SQLMongo\Test\Cases;

class Random1Test extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT * FROM zips WHERE city = 'NEW YORK' OR city = 'CHICAGO' ORDER BY pop DESC LIMIT 10";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Random 1 test');
    }
}
?>
