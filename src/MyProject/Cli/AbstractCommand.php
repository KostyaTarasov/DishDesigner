<?php

namespace MyProject\Cli;

use MyProject\Exceptions\CliException;

abstract class AbstractCommand
{
    /** @var array */
    private $params;

    public function __construct(array $params)
    {
        if (!isset($params[0])) {
            throw new CliException('Пустое значение! Введите код ингредиентов');
        } else {
            $this->params = $params;
        }
    }

    abstract public function execute();

    protected function getParam(): string
    {
        return $this->params[0];
    }
}
