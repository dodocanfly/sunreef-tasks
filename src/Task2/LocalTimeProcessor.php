<?php

namespace Dodocanfly\SunreefTasks\Task2;

class LocalTimeProcessor extends TimeProcessor
{
    public function getDate(): string
    {
        if ($time = strtotime($this->date)) {
            return date(self::DATE_FORMAT, $time);
        }
        return $this->date;
    }
}
