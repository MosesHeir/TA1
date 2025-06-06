--TEST--
phpunit -c ../_files/configuration_stop_on_defect.xml ./tests/_files/MultiDependencyTest.php
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--debug';
$_SERVER['argv'][] = '-c';
$_SERVER['argv'][] = \realpath(__DIR__ . '/../../_files/configuration_execution_order_options.xml');
$_SERVER['argv'][] = \realpath(__DIR__ . '/_files/MultiDependencyTest.php');

require_once __DIR__ . '/../../bootstrap.php';

PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Test 'MultiDependencyTest::testFive' started
Test 'MultiDependencyTest::testFive' ended
Test 'MultiDependencyTest::testFour' started
Test 'MultiDependencyTest::testFour' ended
Test 'MultiDependencyTest::testThree' started
Test 'MultiDependencyTest::testThree' ended
Test 'MultiDependencyTest::testTwo' started
Test 'MultiDependencyTest::testTwo' ended
Test 'MultiDependencyTest::testOne' started
Test 'MultiDependencyTest::testOne' ended


Time: %s, Memory: %s

OK, but incomplete, skipped, or risky tests!
Tests: 5, Assertions: 3, Skipped: 2.
