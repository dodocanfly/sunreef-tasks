<?php

namespace Dodocanfly\SunreefTasks\Task2;

use Dodocanfly\SunreefTasks\Task2\Contracts\TimeProcessorInterface;

abstract class TimeProcessor implements TimeProcessorInterface
{
    const DATE_FORMAT = 'Y-m-d';

    protected ?string $date;

    public function __construct(?string $date = null)
    {
        $this->date = $date;
    }

    abstract public function getDate(): string;
}
