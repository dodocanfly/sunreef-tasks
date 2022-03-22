<?php

namespace Dodocanfly\SunreefTasks\Task1\Tests;

use Dodocanfly\SunreefTasks\Task1\CallbackService;
use Dodocanfly\SunreefTasks\Task1\Exceptions\NoParametersPassedException;
use PHPUnit\Framework\TestCase;

class CallbackServiceTest extends TestCase
{
    private array $callbacksArray;
    private CallbackService $sampleCallbacksContainer;

    protected function setUp(): void
    {
        $this->callbacksArray = [
            ['foo'],
            ['bar'],
            ['baz'],
            ['foo', 'bar'],
            ['foo', 'bar', 'baz'],
        ];

        $this->sampleCallbacksContainer = new CallbackService();
        foreach ($this->callbacksArray as $callback) {
            $this->sampleCallbacksContainer->addCallback(...$callback);
        }
    }

    public function testAddCallbackWithParameters()
    {
        $callbacks = new CallbackService();
        $callbacks->addCallback('foo');
        $this->assertCount(1, $callbacks->getAllCallbacks());
    }

    public function testAddCallbackWithoutParameter()
    {
        $callbacks = new CallbackService();
        $this->expectException(NoParametersPassedException::class);
        $callbacks->addCallback();
    }

    public function testGetRandomCallback()
    {
        self::assertContains($this->sampleCallbacksContainer->getRandomCallback(), $this->callbacksArray);
    }

    public function testGetAllCallbacks()
    {
        self::assertEquals($this->callbacksArray, $this->sampleCallbacksContainer->getAllCallbacks());
    }
}
