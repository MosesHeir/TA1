<?php declare(strict_types=1);
/*
 * This file is part of sebastian/type.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Type\TestFixture;

final class ClassWithMethodsThatDeclareUnionParameterTypes
{
    public function union(bool|int $x): void
    {
    }
}
