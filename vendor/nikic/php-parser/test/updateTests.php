<?php declare(strict_types=1);

namespace PhpParser;

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/PhpParser/CodeTestParser.php';
require __DIR__ . '/PhpParser/CodeParsingTest.php';

$dir = __DIR__ . '/code/parser';

$testParser = new CodeTestParser();
$codeParsingTest = new CodeParsingTest();
foreach (filesInDir($dir, 'test') as $fileName => $code) {
    if (false !== strpos($code, '@@{')) {
        // Skip tests with evaluate segments
        continue;
    }

    list($name, $tests) = $testParser->parseTest($code, 2);
    $newTests = [];
    foreach ($tests as list($modeLine, list($input, $expected))) {
        $modes = $codeParsingTest->parseModeLine($modeLine);
        $parser = $codeParsingTest->createParser($modes['version'] ?? null);
        list(, $output) = $codeParsingTest->getParseOutput($parser, $input, $modes);
        $newTests[] = [$modeLine, [$input, $output]];
    }

    $newCode = $testParser->reconstructTest($name, $newTests);
    file_put_contents($fileName, $newCode);
}
