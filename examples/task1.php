<?php

declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';

use Dodocanfly\SunreefTasks\Task1\CallbackService;


$callbacks = new CallbackService();

$callbacks->addCallback('foo1');
$callbacks->addCallback('foo2', 'bar2');
$callbacks->addCallback('foo3', 'bar3', 'baz3');
$callbacks->addCallback('foo4', 'baz4');
$callbacks->addCallback('bar5', 'baz5');
$callbacks->addCallback('bar6');
$callbacks->addCallback('baz7');


print_r($callbacks->getAllCallbacks());

print_r($callbacks->getRandomCallback());
