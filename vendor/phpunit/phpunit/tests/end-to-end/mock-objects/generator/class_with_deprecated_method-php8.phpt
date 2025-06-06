--TEST--
\PHPUnit\Framework\MockObject\Generator::generate('ClassWithDeprecatedMethod', [], 'MockFoo', TRUE, TRUE)
--SKIPIF--
<?php declare(strict_types=1);
if (PHP_MAJOR_VERSION < 8) {
    print 'skip: PHP 8 is required.';
}
--FILE--
<?php declare(strict_types=1);
class ClassWithDeprecatedMethod
{
    /**
     * @deprecated this method
     *             is deprecated
     */
    public function deprecatedMethod()
    {
    }
}

require_once __DIR__ . '/../../../bootstrap.php';

$generator = new \PHPUnit\Framework\MockObject\Generator;

$mock = $generator->generate(
  'ClassWithDeprecatedMethod',
  [],
  'MockFoo',
  TRUE,
  TRUE
);

print $mock->getClassCode();
--EXPECTF--
declare(strict_types=1);

class MockFoo extends ClassWithDeprecatedMethod implements PHPUnit\Framework\MockObject\MockObject
{
    use \PHPUnit\Framework\MockObject\Api;
    use \PHPUnit\Framework\MockObject\Method;
    use \PHPUnit\Framework\MockObject\MockedCloneMethodWithVoidReturnType;

    public function deprecatedMethod()
    {
        @trigger_error('The ClassWithDeprecatedMethod::deprecatedMethod method is deprecated (this method is deprecated).', E_USER_DEPRECATED);

        $__phpunit_arguments = [];
        $__phpunit_count     = func_num_args();

        if ($__phpunit_count > 0) {
            $__phpunit_arguments_tmp = func_get_args();

            for ($__phpunit_i = 0; $__phpunit_i < $__phpunit_count; $__phpunit_i++) {
                $__phpunit_arguments[] = $__phpunit_arguments_tmp[$__phpunit_i];
            }
        }

        $__phpunit_result = $this->__phpunit_getInvocationHandler()->invoke(
            new \PHPUnit\Framework\MockObject\Invocation(
                'ClassWithDeprecatedMethod', 'deprecatedMethod', $__phpunit_arguments, '', $this, true
            )
        );

        return $__phpunit_result;
    }
}
