<?php
/**
 * This file is part of vfsStream.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package  org\bovigo\vfs
 */
namespace org\bovigo\vfs;
/**
 * Test for org\bovigo\vfs\vfsStreamBlock.
 */
class vfsStreamBlockTestCase extends \BC_PHPUnit_Framework_TestCase
{
    /**
     * The block device being tested.
     *
     * @var vfsStreamBlock $block
     */
    protected $block;

    public function setUp(): void
    {
        $this->block = new vfsStreamBlock('foo');
    }

    /**
     * test default values and methods
     *
     * @test
     */
    public function defaultValues()
    {
        $this->assertEquals(vfsStreamContent::TYPE_BLOCK, $this->block->getType());
        $this->assertEquals('foo', $this->block->getName());
        $this->assertTrue($this->block->appliesTo('foo'));
        $this->assertFalse($this->block->appliesTo('foo/bar'));
        $this->assertFalse($this->block->appliesTo('bar'));
    }

    /**
     * tests how external functions see this object
     *
     * @test
     */
    public function external()
    {
        $root = vfsStream::setup('root');
        $root->addChild(vfsStream::newBlock('foo'));
        $this->assertEquals('block', filetype(vfsStream::url('root/foo')));
    }

    /**
     * tests adding a complex structure
     *
     * @test
     */
    public function addStructure()
    {
        $structure = array(
            'topLevel' => array(
                'thisIsAFile' => 'file contents',
                '[blockDevice]' => 'block contents'
            )
        );

        $root = vfsStream::create($structure);

        $this->assertSame('block', filetype(vfsStream::url('root/topLevel/blockDevice')));
    }

    /**
     * tests that a blank name for a block device throws an exception
     * @test
     */
    public function createWithEmptyName()
    {
        $this->expectException(vfsStreamException::class);
        $structure = array(
            'topLevel' => array(
                'thisIsAFile' => 'file contents',
                '[]' => 'block contents'
            )
        );

        $root = vfsStream::create($structure);
    }
}
