<?php

require_once dirname(__FILE__) . '/../../../vendor/autoload.php';

if (!isTestDatabase()) {
	installTestDatabase();
}

/**
 * @return string|null
 */
function getDatabaseName()
{
	$settings = \SQLMongo\Model\Settings::getInstance()->getSettings();

	if (empty($settings['database']['name'])) {
		return NULL;
	}

	return $settings['database']['name'];
}

/**
 * @return bool
 */
function isTestDatabase()
{
	$collectionsCounter = 0;
	$database = getDatabaseName();

	foreach ((new \MongoDB\Client)->$database->listCollections() as $collection) {
		$collectionsCounter++;
	}

	return $collectionsCounter > 0;
}

/**
 * Install Mongo example data
 */
function installTestDatabase()
{
	$file = 'http://media.mongodb.org/zips.json';
	$zips = file($file, FILE_IGNORE_NEW_LINES);

	$bulk = new MongoDB\Driver\BulkWrite;

	foreach ($zips as $string) {
		$document = json_decode($string);
		$bulk->insert($document);
	}

	$manager = new MongoDB\Driver\Manager('mongodb://localhost');
	$database = getDatabaseName();

	$manager->executeBulkWrite("{$database}.zips", $bulk);
}

/**
 * Helper function for getting the expected result.
 *
 * @param string $testFilePath
 * @return string
 */
function getExpectedValue($testFilePath) {
	$standardFileName = substr(pathinfo($testFilePath, PATHINFO_BASENAME), 0, -8) . "Standard.json";
	$standardDirName = dirname(__FILE__) . '/Expected/';
	$standardFilePath = $standardDirName . $standardFileName;

	return file_get_contents($standardFilePath);
}

/**
 * @return SQLMongo\SQLMongo
 */
function getSQLMongoResponse($query) {
	$sqlMongo = new SQLMongo\SQLMongo;
	$sqlMongo->init();


	ob_start();
	$sqlMongo->execute($query);

	$sqlMongoResponse = trim(ob_get_contents());
	ob_end_clean();

	return $sqlMongoResponse;
}

?>
