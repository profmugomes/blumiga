<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class PathTraversalTest extends TestCase
{
    private string $testDir;

    protected function setUp(): void
    {
        $this->testDir = sys_get_temp_dir() . '/blumiga_test_' . uniqid();
        mkdir($this->testDir, 0755, true);
    }

    protected function tearDown(): void
    {
        if (is_dir($this->testDir)) {
            $files = glob($this->testDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($this->testDir);
        }
    }

    public function testReadFileTraversalBlocked(): void
    {
        $this->assertSame('', readFileContent('../../etc/passwd'));
    }

    public function testReadFileAbsoluteTraversalBlocked(): void
    {
        $this->assertSame('', readFileContent('/etc/passwd'));
    }

    public function testWriteFileTraversalBlocked(): void
    {
        $this->assertFalse(writeFileContent('../../tmp/evil.php', 'hack'));
    }

    public function testWriteFileAbsoluteTraversalBlocked(): void
    {
        $this->assertFalse(writeFileContent('/tmp/evil.php', 'hack'));
    }

    public function testDeleteFileTraversalBlocked(): void
    {
        $this->assertFalse(deleteFile('../../etc/passwd'));
    }

    public function testDeleteFileAbsoluteTraversalBlocked(): void
    {
        $this->assertFalse(deleteFile('/etc/passwd'));
    }

    public function testDeleteDirTraversalBlocked(): void
    {
        $this->assertFalse(deleteDir('../../'));
    }

    public function testDeleteDirAbsoluteTraversalBlocked(): void
    {
        $this->assertFalse(deleteDir('/'));
    }

    public function testDeleteDirNonExistentReturnsFalse(): void
    {
        $this->assertFalse(deleteDir('/caminho/que/nao/existe'));
    }

    public function testDeleteFileDirectoryReturnsFalse(): void
    {
        $this->assertFalse(deleteFile(__DIR__));
    }
}
