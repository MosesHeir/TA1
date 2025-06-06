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

use PharIo\Version\ExactVersionConstraint;
use PHPUnit\Framework\TestCase;

/**
 * @covers PharIo\Manifest\PhpVersionRequirement
 *
 * @uses \PharIo\Version\VersionConstraint
 */
class PhpVersionRequirementTest extends TestCase {
    /** @var PhpVersionRequirement */
    private $requirement;

    protected function setUp(): void {
        $this->requirement = new PhpVersionRequirement(new ExactVersionConstraint('7.1.0'));
    }

    public function testCanBeCreated(): void {
        $this->assertInstanceOf(PhpVersionRequirement::class, $this->requirement);
    }

    public function testVersionConstraintCanBeRetrieved(): void {
        $this->assertEquals('7.1.0', $this->requirement->getVersionConstraint()->asString());
    }
}
