<?php

namespace SQLMongo\Controller;

class Factory
{
    const SELECT_OPERATION = 'SELECT';
    const INSERT_OPERATION = 'INSERT';
    const UPDATE_OPERATION = 'UPDATE';
    const DELETE_OPERATION = 'DELETE';

    /**
     * @var string|null
     */
    private $input = NULL;
    /**
     * @var string|null
     */
    private $operation = NULL;

    /**
     * @param string $input
     * @throws \Exception
     */
    private function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * @return null|string
     */
    private function getInput()
    {
        return $this->input;
    }

    /**
     * @param string $operation
     */
    private function setOperation($operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return string|null
     */
    private function getOperation()
    {
        return $this->operation;
    }

    ##===========================================

    /**
     * Creates controller instance
     * @param string $input
     * @return mixed
     * @throws \Exception
     */
    public function getController($input)
    {
        $this->setInput($input);
        $this->initialize();

        return $this->initializeController();
    }

    /**
     * @return BaseController
     */
    private function initializeController()
    {
        $namespace = "SQLMongo\\Controller\\MongoDB\\";
        $className = ucfirst(strtolower($this->getOperation())) . "Controller";

        $controllerClassName = $namespace . $className;

        $controller = new $controllerClassName($this->getInput());

        return $controller;
    }

    ##===========================================

    /**
     * @throws \Exception
     */
    private function initialize()
    {
        if (empty(trim($this->getInput()))) {
            throw new \Exception('Input empty');
        }

        $this->setOperation($this->getOperationFromInput());

        if (!$this->isOperationPossible()) {
            throw new \Exception('Undefined operation');
        }

        if (!$this->isOperationAvailable()) {
            throw new \Exception('This operation will be implemented in next version');
        }
    }

    /**
     * @return string
     */
    private function getOperationFromInput()
    {
        return strstr($this->getInput(), ' ', true);
    }

    /**
     * @return bool
     */
    private function isOperationAvailable() {
        return in_array($this->getOperation(), $this->getAvailableOperations());
    }

    /**
     * @return array
     */
    private function getAvailableOperations()
    {
        return [
            self::SELECT_OPERATION,
        ];
    }

    /**
     * @return bool
     */
    private function isOperationPossible() {
        return in_array($this->getOperation(), $this->getPossibleOperations());
    }

    /**
     * @return array
     */
    private function getPossibleOperations()
    {
        return [
            self::SELECT_OPERATION,
            self::INSERT_OPERATION,
            self::UPDATE_OPERATION,
            self::DELETE_OPERATION,
        ];
    }
}