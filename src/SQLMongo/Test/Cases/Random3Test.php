<?php

namespace SQLMongo\Test\Cases;

class Random3Test extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT id, loc, state FROM zips WHERE pop > 20000 AND state = 'NJ' AND pop < 30000 ORDER BY pop ASC SKIP 1 LIMIT 5";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Random 3 test');
    }
}
?>
