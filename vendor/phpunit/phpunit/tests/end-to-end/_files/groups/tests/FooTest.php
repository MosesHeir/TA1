<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\TestFixture\Groups;

use PHPUnit\Framework\TestCase;

final class FooTest extends TestCase
{
    /**
     * @group one
     */
    public function testOne(): void
    {
        $this->assertTrue(true);
    }

    /**
     * @group two
     */
    public function testTwo(): void
    {
        $this->assertTrue(true);
    }

    public function testThree(): void
    {
        $this->assertTrue(true);
    }
}
