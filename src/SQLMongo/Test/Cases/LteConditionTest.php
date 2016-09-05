<?php

namespace SQLMongo\Test\Cases;

class LteConditionTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT id, city, loc FROM zips WHERE pop <= 20000 ORDER BY pop DESC LIMIT 15";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Less than or equal condition test');
    }
}
?>
