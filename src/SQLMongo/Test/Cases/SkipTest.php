<?php

namespace SQLMongo\Test\Cases;

class SkipTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT pop FROM zips SKIP 25 ORDER BY pop ASC LIMIT 3";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Skip test');
    }
}
?>
