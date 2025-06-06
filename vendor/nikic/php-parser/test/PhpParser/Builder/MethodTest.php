<?php declare(strict_types=1);

namespace PhpParser\Builder;

use PhpParser\Comment;
use PhpParser\Modifiers;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr\Print_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt;

class MethodTest extends \PHPUnit\Framework\TestCase {
    public function createMethodBuilder($name) {
        return new Method($name);
    }

    public function testModifiers(): void {
        $node = $this->createMethodBuilder('test')
            ->makePublic()
            ->makeAbstract()
            ->makeStatic()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('test', [
                'flags' => Modifiers::PUBLIC | Modifiers::ABSTRACT | Modifiers::STATIC,
                'stmts' => null,
            ]),
            $node
        );

        $node = $this->createMethodBuilder('test')
            ->makeProtected()
            ->makeFinal()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('test', [
                'flags' => Modifiers::PROTECTED | Modifiers::FINAL
            ]),
            $node
        );

        $node = $this->createMethodBuilder('test')
            ->makePrivate()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('test', [
                'type' => Modifiers::PRIVATE
            ]),
            $node
        );
    }

    public function testReturnByRef(): void {
        $node = $this->createMethodBuilder('test')
            ->makeReturnByRef()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('test', [
                'byRef' => true
            ]),
            $node
        );
    }

    public function testParams(): void {
        $param1 = new Node\Param(new Variable('test1'));
        $param2 = new Node\Param(new Variable('test2'));
        $param3 = new Node\Param(new Variable('test3'));

        $node = $this->createMethodBuilder('test')
            ->addParam($param1)
            ->addParams([$param2, $param3])
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('test', [
                'params' => [$param1, $param2, $param3]
            ]),
            $node
        );
    }

    public function testStmts(): void {
        $stmt1 = new Print_(new String_('test1'));
        $stmt2 = new Print_(new String_('test2'));
        $stmt3 = new Print_(new String_('test3'));

        $node = $this->createMethodBuilder('test')
            ->addStmt($stmt1)
            ->addStmts([$stmt2, $stmt3])
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('test', [
                'stmts' => [
                    new Stmt\Expression($stmt1),
                    new Stmt\Expression($stmt2),
                    new Stmt\Expression($stmt3),
                ]
            ]),
            $node
        );
    }
    public function testDocComment(): void {
        $node = $this->createMethodBuilder('test')
            ->setDocComment('/** Test */')
            ->getNode();

        $this->assertEquals(new Stmt\ClassMethod('test', [], [
            'comments' => [new Comment\Doc('/** Test */')]
        ]), $node);
    }

    public function testAddAttribute(): void {
        $attribute = new Attribute(
            new Name('Attr'),
            [new Arg(new Int_(1), false, false, [], new Identifier('name'))]
        );
        $attributeGroup = new AttributeGroup([$attribute]);

        $node = $this->createMethodBuilder('attributeGroup')
            ->addAttribute($attributeGroup)
            ->getNode();

        $this->assertEquals(new Stmt\ClassMethod('attributeGroup', [
            'attrGroups' => [$attributeGroup],
        ], []), $node);
    }

    public function testReturnType(): void {
        $node = $this->createMethodBuilder('test')
            ->setReturnType('bool')
            ->getNode();
        $this->assertEquals(new Stmt\ClassMethod('test', [
            'returnType' => new Identifier('bool'),
        ], []), $node);
    }

    public function testAddStmtToAbstractMethodError(): void {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Cannot add statements to an abstract method');
        $this->createMethodBuilder('test')
            ->makeAbstract()
            ->addStmt(new Print_(new String_('test')))
        ;
    }

    public function testMakeMethodWithStmtsAbstractError(): void {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Cannot make method with statements abstract');
        $this->createMethodBuilder('test')
            ->addStmt(new Print_(new String_('test')))
            ->makeAbstract()
        ;
    }

    public function testInvalidParamError(): void {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Expected parameter node, got "Name"');
        $this->createMethodBuilder('test')
            ->addParam(new Node\Name('foo'))
        ;
    }
}
