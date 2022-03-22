<?php

namespace Dodocanfly\SunreefTasks\Task1\Exceptions;

class NoParametersPassedException extends \BadMethodCallException
{
    protected $message = 'You must pass at least one parameter to method';
}