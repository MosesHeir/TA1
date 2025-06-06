<?php declare(strict_types = 1);
/*
 * This file is part of PharIo\Manifest.
 *
 * Copyright (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de> and contributors
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace PharIo\Manifest;

/**
 * @covers \PharIo\Manifest\ManifestDocumentMapper
 *
 * @uses \PharIo\Manifest\ApplicationName
 * @uses \PharIo\Manifest\Author
 * @uses \PharIo\Manifest\AuthorCollection
 * @uses \PharIo\Manifest\AuthorCollectionIterator
 * @uses \PharIo\Manifest\AuthorElement
 * @uses \PharIo\Manifest\AuthorElementCollection
 * @uses \PharIo\Manifest\BundledComponent
 * @uses \PharIo\Manifest\BundledComponentCollection
 * @uses \PharIo\Manifest\BundledComponentCollectionIterator
 * @uses \PharIo\Manifest\BundlesElement
 * @uses \PharIo\Manifest\ComponentElement
 * @uses \PharIo\Manifest\ComponentElementCollection
 * @uses \PharIo\Manifest\ContainsElement
 * @uses \PharIo\Manifest\CopyrightElement
 * @uses \PharIo\Manifest\CopyrightInformation
 * @uses \PharIo\Manifest\ElementCollection
 * @uses \PharIo\Manifest\Email
 * @uses \PharIo\Manifest\ExtElement
 * @uses \PharIo\Manifest\ExtElementCollection
 * @uses \PharIo\Manifest\License
 * @uses \PharIo\Manifest\LicenseElement
 * @uses \PharIo\Manifest\Manifest
 * @uses \PharIo\Manifest\ManifestDocument
 * @uses \PharIo\Manifest\ManifestDocumentMapper
 * @uses \PharIo\Manifest\ManifestElement
 * @uses \PharIo\Manifest\ManifestLoader
 * @uses \PharIo\Manifest\PhpElement
 * @uses \PharIo\Manifest\PhpExtensionRequirement
 * @uses \PharIo\Manifest\PhpVersionRequirement
 * @uses \PharIo\Manifest\RequirementCollection
 * @uses \PharIo\Manifest\RequirementCollectionIterator
 * @uses \PharIo\Manifest\RequiresElement
 * @uses \PharIo\Manifest\Type
 * @uses \PharIo\Manifest\Url
 * @uses \PharIo\Version\Version
 * @uses \PharIo\Version\VersionConstraint
 */
class ManifestDocumentMapperTest extends \PHPUnit\Framework\TestCase {
    /**
     * @dataProvider dataProvider
     *
     * @uses         \PharIo\Manifest\Application
     * @uses         \PharIo\Manifest\ApplicationName
     * @uses         \PharIo\Manifest\Library
     * @uses         \PharIo\Manifest\Extension
     * @uses         \PharIo\Manifest\ExtensionElement
     */
    public function testCanSerializeToString($expected): void {
        $manifestDocument = ManifestDocument::fromFile($expected);
        $mapper           = new ManifestDocumentMapper();

        $this->assertInstanceOf(
            Manifest::class,
            $mapper->map($manifestDocument)
        );
    }

    public function dataProvider() {
        return [
            'application'   => [__DIR__ . '/_fixture/phpunit-5.6.5.xml'],
            'library'       => [__DIR__ . '/_fixture/library.xml'],
            'extension'     => [__DIR__ . '/_fixture/extension.xml'],
            'noemailauthor' => [__DIR__ . '/_fixture/noemailauthor.xml']
        ];
    }

    public function testThrowsExceptionOnUnsupportedType(): void {
        $manifestDocument = ManifestDocument::fromFile(__DIR__ . '/_fixture/custom.xml');
        $mapper           = new ManifestDocumentMapper();

        $this->expectException(ManifestDocumentMapperException::class);
        $mapper->map($manifestDocument);
    }

    public function testInvalidVersionInformationThrowsException(): void {
        $manifestDocument = ManifestDocument::fromFile(__DIR__ . '/_fixture/invalidversion.xml');
        $mapper           = new ManifestDocumentMapper();

        $this->expectException(ManifestDocumentMapperException::class);
        $mapper->map($manifestDocument);
    }

    public function testInvalidVersionConstraintThrowsException(): void {
        $manifestDocument = ManifestDocument::fromFile(__DIR__ . '/_fixture/invalidversionconstraint.xml');
        $mapper           = new ManifestDocumentMapper();

        $this->expectException(ManifestDocumentMapperException::class);
        $mapper->map($manifestDocument);
    }

    /**
     * @uses \PharIo\Manifest\ExtensionElement
     */
    public function testInvalidCompatibleConstraintThrowsException(): void {
        $manifestDocument = ManifestDocument::fromFile(__DIR__ . '/_fixture/extension-invalidcompatible.xml');
        $mapper           = new ManifestDocumentMapper();

        $this->expectException(ManifestDocumentMapperException::class);
        $mapper->map($manifestDocument);
    }
}
