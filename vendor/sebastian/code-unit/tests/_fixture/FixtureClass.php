<?php declare(strict_types=1);
/*
 * This file is part of sebastian/code-unit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeUnit\Fixture;

class FixtureClass
{
    public function publicMethod(): void
    {
        // ...
    }

    protected function protectedMethod(): void
    {
        // ...
    }

    private function privateMethod(): void
    {
        // ...
    }
}
