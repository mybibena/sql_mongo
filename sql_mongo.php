<?php

/**
 * Alternative MongoDB CLI Client with SQL-like syntax
 */

namespace SQLMongo;

$autoloadFilePath =  __DIR__ . '/vendor/autoload.php';

if (!is_file($autoloadFilePath)) {
    die ("Please switch to project directory in console and execute composer install\n");
}

require_once $autoloadFilePath;

if ($argc != 2) {
    die("Only one parameter required\n");
}
$input = $argv[1];

$SQLMongo = new SQLMongo;

$SQLMongo->init();
$SQLMongo->execute($input);