<?php

namespace SQLMongo\Test\Cases;

class WrongParams5Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Query parsing error: GROUP BY expression will be implemented in next version
     */
    public function test() {
        $query = "SELECT * FROM zips WHERE state = 'IL' GROUP BY city";

        $sqlMongo = new \SQLMongo\SQLMongo;
        $sqlMongo->init();

        $sqlMongo->execute($query);
    }
}
?>
