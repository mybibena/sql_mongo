<?php

namespace SQLMongo\Test\Cases;

class Random2Test extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT * FROM zips WHERE city = 'JERSEY CITY' XOR state = 'NJ' ORDER BY pop DESC SKIP 3 LIMIT 10";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Random 2 test');
    }
}
?>
