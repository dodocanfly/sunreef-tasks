<?php

namespace Dodocanfly\SunreefTasks\Task2\Tests;

use Dodocanfly\SunreefTasks\Task2\DatetimeService;
use Dodocanfly\SunreefTasks\Task2\LocalTimeProcessor;
use Dodocanfly\SunreefTasks\Task2\ProductionTimeProcessor;
use PHPUnit\Framework\TestCase;

class DatetimeServiceTest extends TestCase
{
    public function testGetDateForLocalEnvironment()
    {
        $date = '2055-03-21';
        $datetimeService = new DatetimeService(new LocalTimeProcessor($date));
        self::assertEquals($date, $datetimeService->getDate());
    }

    public function testGetDateForProductionEnvironment()
    {
        $date = date('Y-m-d');
        $datetimeService = new DatetimeService(new ProductionTimeProcessor());
        self::assertEquals($date, $datetimeService->getDate());
    }
}
