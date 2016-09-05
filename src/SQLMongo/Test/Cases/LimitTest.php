<?php

namespace SQLMongo\Test\Cases;

class LimitTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT pop FROM zips ORDER BY pop DESC LIMIT 12";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Limit test');
    }
}
?>
