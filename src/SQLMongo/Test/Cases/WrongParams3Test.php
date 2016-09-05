<?php

namespace SQLMongo\Test\Cases;

class WrongParams3Test extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT * FROM zips WHERE wrong_field = 12";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Wrong params 3 test');
    }
}
?>
