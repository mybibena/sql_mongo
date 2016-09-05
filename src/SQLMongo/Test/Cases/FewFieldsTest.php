<?php

namespace SQLMongo\Test\Cases;

class FewFieldTest extends \PHPUnit_Framework_TestCase
{
    public function test() {
        $query = "SELECT pop, city FROM zips ORDER BY pop ASC LIMIT 1";

        $result = getSQLMongoResponse($query);
        $expected = getExpectedValue(__FILE__);

        $this->assertEquals($expected, $result, 'Few fields test');
    }
}
?>
