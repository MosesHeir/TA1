<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

use function array_reduce;
use function array_shift;

/**
 * @small
 */
final class LogicalOrTest extends BinaryOperatorTestCase
{
    public static function getOperatorName(): string
    {
        return 'or';
    }

    public static function getOperatorPrecedence(): int
    {
        return 24;
    }

    public function evaluateExpectedResult(array $input): bool
    {
        $initial = (bool) array_shift($input);

        return array_reduce($input, static function ($carry, bool $item): bool
        {
            return $carry || $item;
        }, $initial);
    }
}
