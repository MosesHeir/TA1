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

use const JSON_ERROR_CTRL_CHAR;
use const JSON_ERROR_DEPTH;
use const JSON_ERROR_NONE;
use const JSON_ERROR_STATE_MISMATCH;
use const JSON_ERROR_SYNTAX;
use const JSON_ERROR_UTF8;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

/**
 * @small
 */
final class JsonMatchesErrorMessageProviderTest extends TestCase
{
    public static function determineJsonErrorDataprovider(): array
    {
        return [
            'JSON_ERROR_NONE' => [
                null, JSON_ERROR_NONE, '',
            ],
            'JSON_ERROR_DEPTH' => [
                'Maximum stack depth exceeded', JSON_ERROR_DEPTH, '',
            ],
            'prefixed JSON_ERROR_DEPTH' => [
                'TUX: Maximum stack depth exceeded', JSON_ERROR_DEPTH, 'TUX: ',
            ],
            'JSON_ERROR_STATE_MISMatch' => [
                'Underflow or the modes mismatch', JSON_ERROR_STATE_MISMATCH, '',
            ],
            'JSON_ERROR_CTRL_CHAR' => [
                'Unexpected control character found', JSON_ERROR_CTRL_CHAR, '',
            ],
            'JSON_ERROR_SYNTAX' => [
                'Syntax error, malformed JSON', JSON_ERROR_SYNTAX, '',
            ],
            'JSON_ERROR_UTF8`' => [
                'Malformed UTF-8 characters, possibly incorrectly encoded',
                JSON_ERROR_UTF8,
                '',
            ],
            'Invalid error indicator' => [
                'Unknown error', 55, '',
            ],
        ];
    }

    public static function translateTypeToPrefixDataprovider(): array
    {
        return [
            'expected' => ['Expected value JSON decode error - ', 'expected'],
            'actual'   => ['Actual value JSON decode error - ', 'actual'],
            'default'  => ['', ''],
        ];
    }

    /**
     * @dataProvider translateTypeToPrefixDataprovider
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testTranslateTypeToPrefix($expected, $type): void
    {
        $this->assertEquals(
            $expected,
            JsonMatchesErrorMessageProvider::translateTypeToPrefix($type),
        );
    }

    /**
     * @testdox Determine JSON error $_dataName
     *
     * @dataProvider determineJsonErrorDataprovider
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testDetermineJsonError($expected, $error, $prefix): void
    {
        $this->assertEquals(
            $expected,
            JsonMatchesErrorMessageProvider::determineJsonError(
                (string) $error,
                $prefix,
            ),
        );
    }
}
