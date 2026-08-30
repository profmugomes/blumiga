<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class InputHelperTest extends TestCase
{
    private string $originalMethod;

    protected function setUp(): void
    {
        $this->originalMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    protected function tearDown(): void
    {
        $_SERVER['REQUEST_METHOD'] = $this->originalMethod;
    }

    public function testRequestGetReturnsTrue(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->assertTrue(requestGET());
    }

    public function testRequestGetReturnsFalseForPost(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertFalse(requestGET());
    }

    public function testRequestPostReturnsTrue(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertTrue(requestPOST());
    }

    public function testRequestPostReturnsFalseForGet(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->assertFalse(requestPOST());
    }

    public function testDocumentroot(): void
    {
        $root = documentroot();
        $this->assertDirectoryExists($root);
        $this->assertFileExists($root . '/core/functions.php');
    }

    public function testAssetReturnsString(): void
    {
        $result = asset('assets/css/style.css');
        $this->assertIsString($result);
        $this->assertStringStartsWith('/', $result);
    }

    public function testAssetNonExistentFile(): void
    {
        $result = asset('assets/nonexistent.css');
        $this->assertStringStartsWith('/', $result);
        $this->assertStringNotContainsString('?v=', $result);
    }
}
