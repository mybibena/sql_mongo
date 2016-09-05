<?php

namespace SQLMongo\Test\Cases;

class LtConditionTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT id, city FROM zips WHERE pop < 20000 ORDER BY pop DESC LIMIT 15";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Less than condition test');
    }
}
?>
