<?php

namespace SQLMongo\Test\Cases;

class OrConditionTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT pop FROM zips WHERE city = 'JERSEY CITY' OR state = 'NJ' ORDER BY pop DESC SKIP 2 LIMIT 15";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'OR condition test');
    }
}
?>
