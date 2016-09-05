<?php

namespace SQLMongo\Model\SQLParser;

abstract class BaseParser
{
    /**
     * @param array $expression
     * @return mixed
     */
    abstract public function parse($expression);
}