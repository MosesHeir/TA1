--TEST--
TestDox: Default output; Data Provider with numeric data set name; TestDox metadata with placeholders
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--testdox';
$_SERVER['argv'][] = '--colors=never';
$_SERVER['argv'][] = __DIR__ . '/_files/DataProviderWithNumericDataSetNameAndMetadataWithPlaceholdersTest.php';

require_once __DIR__ . '/../../bootstrap.php';

PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Text from class-level TestDox metadata
 ✔ Text from method-level TestDox metadata for successful test with placeholders (string, 0, 0.0 array, true)
 ✘ Text from method-level TestDox metadata for failing test with placeholders (string, 0, 0.0 array, true)
   │
   │ Failed asserting that false is true.
   │
   │ %s:%d
   │

Time: %s, Memory: %s

Summary of non-successful tests:

Text from class-level TestDox metadata
 ✘ Text from method-level TestDox metadata for failing test with placeholders (string, 0, 0.0 array, true)
   │
   │ Failed asserting that false is true.
   │
   │ %s:%d
   │

FAILURES!
Tests: 2, Assertions: 2, Failures: 1.
