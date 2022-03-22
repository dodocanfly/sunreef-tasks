<?php

declare(strict_types=1);

use Dodocanfly\SunreefTasks\Task4\SunReefValidator;

require_once __DIR__ . '/../vendor/autoload.php';


$data = [
    'arrayDivident' => [
        1,2,3,4,11,22,33,44,800
    ],
//    'divisor' => 2,
    'square' => 27,
    'power' => 3,
];


if (SunReefValidator::valid($data)) {
    echo "VALID\n";
} else {
    echo "INVALID\n";
}
