<?php
/**
 * This file is part of vfsStream.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package  org\bovigo\vfs
 */
namespace org\bovigo\vfs\visitor;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStreamBlock;
/**
 * Test for org\bovigo\vfs\visitor\vfsStreamAbstractVisitor.
 *
 * @since  0.10.0
 * @see    https://github.com/mikey179/vfsStream/issues/10
 * @group  issue_10
 */
class vfsStreamAbstractVisitorTestCase extends \BC_PHPUnit_Framework_TestCase
{
    /**
     * instance to test
     *
     * @var  vfsStreamAbstractVisitor
     */
    protected $abstractVisitor;

    /**
     * set up test environment
     */
    public function setUp(): void
    {
        $this->abstractVisitor = $this->bc_getMock('org\\bovigo\\vfs\\visitor\\vfsStreamAbstractVisitor',
                                                array('visitFile', 'visitDirectory')
                                 );
    }

    /**
     * @test
     */
    public function visitThrowsInvalidArgumentExceptionOnUnknownContentType()
    {
        $this->expectException(\InvalidArgumentException::class);
        $mockContent = $this->bc_getMock('org\\bovigo\\vfs\\vfsStreamContent');
        $mockContent->expects($this->any())
                    ->method('getType')
                    ->will($this->returnValue('invalid'));
        $this->assertSame($this->abstractVisitor,
                          $this->abstractVisitor->visit($mockContent)
        );
    }

    /**
     * @test
     */
    public function visitWithFileCallsVisitFile()
    {
        $file = new vfsStreamFile('foo.txt');
        $this->abstractVisitor->expects($this->once())
                              ->method('visitFile')
                              ->with($this->equalTo($file));
        $this->assertSame($this->abstractVisitor,
                          $this->abstractVisitor->visit($file)
        );
    }

    /**
     * tests that a block device eventually calls out to visit file
     *
     * @test
     */
    public function visitWithBlockCallsVisitFile()
    {
        $block = new vfsStreamBlock('foo');
        $this->abstractVisitor->expects($this->once())
                              ->method('visitFile')
                              ->with($this->equalTo($block));
        $this->assertSame($this->abstractVisitor,
                          $this->abstractVisitor->visit($block)
        );
    }

    /**
     * @test
     */
    public function visitWithDirectoryCallsVisitDirectory()
    {
        $dir = new vfsStreamDirectory('bar');
        $this->abstractVisitor->expects($this->once())
                              ->method('visitDirectory')
                              ->with($this->equalTo($dir));
        $this->assertSame($this->abstractVisitor,
                          $this->abstractVisitor->visit($dir)
        );
    }
}
