<?php

namespace SQLMongo\Model;

use SQLMongo\SQLMongo;

class Settings
{
    /**
     * @var Settings|null
     */
    static private $instance = NULL;

    /**
     * @var array|null
     */
    private $settings = NULL;

    private function __clone() {}

    private function __construct() {}

    /**
     * @static
     * @return Settings
     * @return void
     */
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new Settings();
        }
        return self::$instance;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getSettings()
    {
        $settingsFilePath = $this->getSettingsFilePath();

        if (!is_file($settingsFilePath)) {
            throw new \Exception('Missed settings file');
        }

        if (!is_null($this->settings)) {
            return $this->settings;
        }

        return $this->settings = include $settingsFilePath;
    }

    /**
     * Returns path to settings file
     * @return string
     */
    private function getSettingsFilePath()
    {
        return SQLMongo::BASE_PATH . '/app/settings/settings.php';
    }
}