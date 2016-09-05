<?php

namespace SQLMongo\Test\Cases;

class OrderDescTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT id, city, pop FROM zips ORDER BY pop DESC LIMIT 10";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Order DESC test');
    }
}
?>
