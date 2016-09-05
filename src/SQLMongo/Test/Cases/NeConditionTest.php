<?php

namespace SQLMongo\Test\Cases;

class NeConditionTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT id, city, state FROM zips WHERE state = 'NJ' AND city <> 'JERSEY CITY' ORDER BY pop ASC LIMIT 15";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Not Equal condition test');
    }
}
?>
