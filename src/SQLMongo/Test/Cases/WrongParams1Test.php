<?php

namespace SQLMongo\Test\Cases;

class WrongParams1Test extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT * FROM wrong_collection LIMIT 1";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Wrong params 1 test');
    }
}
?>
