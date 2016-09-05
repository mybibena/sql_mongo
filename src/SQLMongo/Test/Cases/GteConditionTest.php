<?php

namespace SQLMongo\Test\Cases;

class GteConditionTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT pop FROM zips WHERE city = 'NEW YORK' AND pop >= 20000 ORDER BY pop DESC LIMIT 15";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Greater than or equal condition test');
    }
}
?>
