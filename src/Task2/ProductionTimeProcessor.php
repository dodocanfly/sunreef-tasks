<?php

namespace Dodocanfly\SunreefTasks\Task2;

class ProductionTimeProcessor extends TimeProcessor
{
    public function getDate(): string
    {
        return date(self::DATE_FORMAT);
    }
}
