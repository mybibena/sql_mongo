<?php

namespace SQLMongo\Test\Cases;

class IdFieldTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT id FROM zips ORDER BY pop ASC LIMIT 1";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Id field test');
    }
}
?>
