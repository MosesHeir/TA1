<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'prefix' => 'PHPUnitPHAR',

    'exclude-namespaces' => [
        'PHPUnit',
        'Prophecy'
    ],

    'expose-constants' => [
        '/^__PHPUNIT_.+$/'
    ],
];
