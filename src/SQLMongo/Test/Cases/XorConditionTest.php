<?php

namespace SQLMongo\Test\Cases;

class XorConditionTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT pop FROM zips WHERE city = 'JERSEY CITY' XOR state = 'NJ' ORDER BY pop ASC SKIP 2 LIMIT 15";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'XOR condition test');
    }
}
?>
