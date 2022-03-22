<?php

namespace Dodocanfly\SunreefTasks\Task1;

use Dodocanfly\SunreefTasks\Task1\Exceptions\NoParametersPassedException;

class CallbackService
{
    private array $callbacks;

    public function __construct()
    {
        $this->callbacks = [];
    }

    public function addCallback(...$params): void
    {
        if (empty($params)) {
            throw new NoParametersPassedException();
        }
        $this->callbacks[] = $params;
    }

    public function getAllCallbacks(): array
    {
        return $this->callbacks;
    }

    public function getRandomCallback(): array
    {
        if (empty($this->callbacks)) return $this->callbacks;

        $randKey = array_rand($this->callbacks);
        return $this->callbacks[$randKey];
    }
}
