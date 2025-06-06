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
 * Test for directory iteration.
 *
 * @group  issue_104
 * @group  issue_128
 * @since  1.6.2
 */
class FilenameTestCase extends \BC_PHPUnit_Framework_TestCase
{
    private $rootDir;
    private $lostAndFound;

    /**
     * set up test environment
     */
    public function setUp(): void
    {
        vfsStream::setup('root');
        $this->rootDir = vfsStream::url('root');
        $this->lostAndFound = $this->rootDir . '/lost+found/';
        mkdir($this->lostAndFound);
    }

    /**
     * @test
     */
    public function worksWithCorrectName()
    {
        $results = array();
        $it = new \RecursiveDirectoryIterator($this->lostAndFound);
        foreach ($it as $f) {
            $results[] = $f->getPathname();
        }

        $this->assertEquals(
                array(
                        'vfs://root/lost+found' . DIRECTORY_SEPARATOR . '.',
                        'vfs://root/lost+found' . DIRECTORY_SEPARATOR . '..'
                ),
                $results
        );
    }

    /**
     * @test
     */
    public function doesNotWorkWithInvalidName()
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('ailed to open dir');
        $results = array();
        $it = new \RecursiveDirectoryIterator($this->rootDir . '/lost found/');
        foreach ($it as $f) {
            $results[] = $f->getPathname();
        }
    }

    /**
     * @test
     */
    public function returnsCorrectNames()
    {
        $results = array();
        $it = new \RecursiveDirectoryIterator($this->rootDir);
        foreach ($it as $f) {
            $results[] = $f->getPathname();
        }

        $this->assertEquals(
                array(
                        'vfs://root' . DIRECTORY_SEPARATOR . '.',
                        'vfs://root' . DIRECTORY_SEPARATOR . '..',
                        'vfs://root' . DIRECTORY_SEPARATOR . 'lost+found'
                ),
                $results
        );
    }
}
