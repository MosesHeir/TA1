--TEST--
\PHPUnit\Framework\MockObject\Generator::generate('Foo', [], 'MockFoo', true, true)
--SKIPIF--
<?php declare(strict_types=1);
if (version_compare('8.2.0-dev', PHP_VERSION, '>')) {
    print 'skip: PHP 8.2 is required.';
}
--FILE--
<?php declare(strict_types=1);
interface Foo
{
    public function bar(null $baz): void;
}

require_once __DIR__ . '/../../../../vendor/autoload.php';

$generator = new \PHPUnit\Framework\MockObject\Generator;

$mock = $generator->generate(
    'Foo',
    [],
    'MockFoo',
    true,
    true
);

print $mock->getClassCode();
--EXPECTF--
declare(strict_types=1);

class MockFoo implements PHPUnit\Framework\MockObject\MockObject, Foo
{
    use \PHPUnit\Framework\MockObject\Api;
    use \PHPUnit\Framework\MockObject\Method;
    use \PHPUnit\Framework\MockObject\MockedCloneMethodWithVoidReturnType;

    public function bar(null $baz): void
    {
        $__phpunit_arguments = [$baz];
        $__phpunit_count     = func_num_args();

        if ($__phpunit_count > 1) {
            $__phpunit_arguments_tmp = func_get_args();

            for ($__phpunit_i = 1; $__phpunit_i < $__phpunit_count; $__phpunit_i++) {
                $__phpunit_arguments[] = $__phpunit_arguments_tmp[$__phpunit_i];
            }
        }

        $this->__phpunit_getInvocationHandler()->invoke(
            new \PHPUnit\Framework\MockObject\Invocation(
                'Foo', 'bar', $__phpunit_arguments, 'void', $this, true
            )
        );
    }
}
