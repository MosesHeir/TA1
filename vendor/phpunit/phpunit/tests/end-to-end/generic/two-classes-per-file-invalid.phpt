--TEST--
phpunit --version
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = __DIR__ . '/../../_files/OneClassPerFile/failing/';

require_once __DIR__ . '/../../bootstrap.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Warning:       Multiple test case classes per file is deprecated
               in %sTwoClassesInvalidTest.php
Warning:       Test case class not matching filename is deprecated
               in %sTwoClassesInvalidTest.php
               Class name was 'TwoClassesInvalid', expected 'TwoClassesInvalidTest'
Warning:       Test case class not matching filename is deprecated
               in %sTwoClassesInvalidTest.php
               Class name was 'TwoClassesInvalid2', expected 'TwoClassesInvalidTest'

..                                                                  2 / 2 (100%)

Time: %s, Memory: %s

OK (2 tests, 2 assertions)
