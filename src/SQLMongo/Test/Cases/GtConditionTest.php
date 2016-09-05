<?php

namespace SQLMongo\Test\Cases;

class GtConditionTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT pop FROM zips WHERE city = 'JERSEY CITY' AND pop > 20000 ORDER BY pop ASC LIMIT 15";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Greater than condition test');
    }
}
?>
