<?php

namespace SQLMongo\Test\Cases;

class SubFieldTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT loc.* FROM zips ORDER BY pop DESC LIMIT 1";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Sub fields test');
    }
}
?>
