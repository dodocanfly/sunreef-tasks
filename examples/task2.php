<?php

declare(strict_types=1);

use Dodocanfly\SunreefTasks\Task2\DatetimeService;
use Dodocanfly\SunreefTasks\Task2\LocalTimeProcessor;
use Dodocanfly\SunreefTasks\Task2\ProductionTimeProcessor;

require_once __DIR__ . '/../vendor/autoload.php';


$cfg = [
    'env' => array_key_exists(1, $argv) ? $argv[1] : 'local',
    'date' => '2055-03-21',
];


if ($cfg['env'] === 'local') {
    $timeProcessor = new LocalTimeProcessor($cfg['date']);
} else {
    $timeProcessor = new ProductionTimeProcessor();
}


$datetimeService = new DatetimeService($timeProcessor);

echo 'Environment: ' . $cfg['env'] . "\n" .
    'Date: ' . $datetimeService->getDate() . "\n";
