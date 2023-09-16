<?php

require __DIR__ . '/../vendor/autoload.php';

try {
    unset($argv[0]);

    $className = '\\MyProject\\Cli\\' . array_shift($argv);
    if (!class_exists($className)) {
        throw new \MyProject\Exceptions\CliException('Class "' . $className . '" not found');
    }

    $class = new $className($argv);
    $class->execute();
} catch (\MyProject\Exceptions\CliException $e) {
    echo 'Error: ' . $e->getMessage();
}
