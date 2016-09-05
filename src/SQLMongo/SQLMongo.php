<?php

namespace SQLMongo;

use SQLMongo\Controller\BaseController;
use SQLMongo\Controller\Factory;
use SQLMongo\Model\Settings;

class SQLMongo
{
    const BASE_PATH = __DIR__ . "/../..";

    /**
     * Initialize application and check settings
     */
    public function init()
    {
        try {
            $this->checkSettings();

            register_shutdown_function(array($this, 'catchFatalError'));

            set_error_handler(array($this, 'phpErrorsHook'));
            set_exception_handler(array($this, 'phpExceptionsHook'));
        } catch (\Exception $e) {
            die("{$e->getMessage()}\n");
        }
    }

    /**
     * @param string $input
     */
    public function execute($input)
    {
        $factory = new Factory();

        /**
         * @var BaseController $controller
         */
        $controller = $factory->getController($input);

        $controller->process();
    }

    ##===========================================

    private function checkSettings()
    {
        $settings = Settings::getInstance()->getSettings();

        if (empty($settings['database']['name'])) {
            throw new \Exception('Database is not defined');
        }
    }

    public function catchFatalError()
    {
        $error = error_get_last();

        if (is_null($error)) {
            return;
        }

        $type = (int)$error['type'];
        if (!in_array($type, [E_ERROR, E_PARSE, E_COMPILE_ERROR, E_COMPILE_WARNING, E_CORE_ERROR])) {
            return;
        }

        die("Fatal Error: {$error['message']}\n");
    }

    public function phpErrorsHook($type, $message, $file, $line)
    {
        die("Error: {$message}\n");
    }

    public function phpExceptionsHook(\Exception $exception)
    {
        die("Exception: {$exception->getMessage()}\n");
    }
}