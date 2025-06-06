<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-invoker.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Invoker\TestFixture;

use function sleep;

final class TestCallable
{
    public function test(int $sleep): bool
    {
        sleep($sleep);

        return true;
    }
}
