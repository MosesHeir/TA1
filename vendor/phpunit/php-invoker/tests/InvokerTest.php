<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-invoker.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Invoker;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use SebastianBergmann\Invoker\TestFixture\TestCallable;

/**
 * @requires extension pcntl
 *
 * @covers \SebastianBergmann\Invoker\Invoker
 */
final class InvokerTest extends TestCase
{
    /**
     * @var TestCallable
     */
    private $callable;

    /**
     * @var Invoker
     */
    private $invoker;

    protected function setUp(): void
    {
        $this->callable = new TestCallable;
        $this->invoker  = new Invoker;
    }

    public function testExecutionOfCallableIsNotAbortedWhenTimeoutIsNotReached(): void
    {
        $this->assertTrue(
            $this->invoker->invoke([$this->callable, 'test'], [0], 1)
        );
    }

    public function testExecutionOfCallableIsAbortedWhenTimeoutIsReached(): void
    {
        $this->expectException(TimeoutException::class);
        $this->expectExceptionMessage('Execution aborted after 1 second');

        $this->invoker->invoke([$this->callable, 'test'], [2], 1);
    }

    public function testRequirementsCanBeChecked(): void
    {
        $this->assertTrue($this->invoker->canInvokeWithTimeout());
    }

    public function testAlarmIsClearedWhenCallableTimeoutIsNotReached(): void
    {
        $this->assertTrue(
            $this->invoker->invoke([$this->callable, 'test'], [0], 1)
        );

        try {
            sleep(1);
        } catch (TimeoutException $e) {
            $this->fail('Alarm timeout was not cleared');
        }
    }

    public function testAlarmIsClearedWhenCallableThrowsException(): void
    {
        $exception = new RuntimeException;

        $callable = static function () use ($exception): void {
            throw $exception;
        };

        try {
            $this->invoker->invoke($callable, [], 1);
        } catch (RuntimeException $e) {
            $this->assertSame($exception, $e);
        }

        try {
            sleep(1);
        } catch (TimeoutException $e) {
            $this->fail('Alarm timeout was not cleared');
        }
    }
}
