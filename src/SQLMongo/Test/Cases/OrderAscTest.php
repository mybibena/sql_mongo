<?php

namespace SQLMongo\Test\Cases;

class OrderAscTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT id, city, pop FROM zips ORDER BY pop ASC LIMIT 10";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Order ASC test');
    }
}
?>
