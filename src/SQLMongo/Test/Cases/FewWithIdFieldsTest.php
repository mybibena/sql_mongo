<?php

namespace SQLMongo\Test\Cases;

class FewWithIdFieldsTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT id, pop FROM zips ORDER BY pop DESC LIMIT 1";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Few with id field test');
    }
}
?>
