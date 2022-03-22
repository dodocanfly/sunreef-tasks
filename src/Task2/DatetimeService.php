<?php

namespace Dodocanfly\SunreefTasks\Task2;

use Dodocanfly\SunreefTasks\Task2\Contracts\TimeProcessorInterface;

class DatetimeService
{
    private TimeProcessorInterface $timeProcessor;

    public function __construct(TimeProcessorInterface $timeProcessor)
    {
        $this->timeProcessor = $timeProcessor;
    }

    public function getDate(): string
    {
        return $this->timeProcessor->getDate();
    }
}
