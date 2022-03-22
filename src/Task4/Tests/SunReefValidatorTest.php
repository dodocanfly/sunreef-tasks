<?php

namespace Dodocanfly\SunreefTasks\Task4\Tests;

use Dodocanfly\SunreefTasks\Task4\SunReefValidator;
use PHPUnit\Framework\TestCase;

class SunReefValidatorTest extends TestCase
{

    public function testEmptyData()
    {
        $data = [];
        self::assertFalse(SunReefValidator::valid($data));
    }

    public function testValidDataWithoutDivisor()
    {
        $data = [
            'arrayDivident' => [
                1,2,3,4,11,22,33,44
            ],
            'square' => 27,
            'power' => 3,
        ];
        self::assertTrue(SunReefValidator::valid($data));
    }

    public function testOnlyArrayDividentData()
    {
        $data = [
            'arrayDivident' => [
                1,2,3,4,11,22,33,44
            ]
        ];
        self::assertFalse(SunReefValidator::valid($data));
    }

    public function testRequiredValidArrayDividentAndSquareData()
    {
        $data = [
            'arrayDivident' => [
                1,2,3,4,11,22,33,44
            ],
            'square' => 16,
        ];
        self::assertTrue(SunReefValidator::valid($data));
    }

    public function testRequiredValidArrayDividentAndInvalidSquareData()
    {
        $data = [
            'arrayDivident' => [
                1,2,3,4,11,22,33,44
            ],
            'square' => 15,
        ];
        self::assertFalse(SunReefValidator::valid($data));
    }

    public function testTooLargeSumOfArrayDivident()
    {
        $data = [
            'arrayDivident' => [
                1,2,3,4,11,22,33,44,999
            ],
            'square' => 27,
            'power' => 3,
        ];
        self::assertFalse(SunReefValidator::valid($data));
    }
}
