<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class EscapeXssTest extends TestCase
{
    public function testEscapeHtmlTags(): void
    {
        $input = '<script>alert(1)</script>';
        $result = e($input);
        $this->assertStringContainsString('&lt;script&gt;', $result);
        $this->assertStringNotContainsString('<script>', $result);
    }

    public function testEscapeNullReturnsEmpty(): void
    {
        $this->assertSame('', e(null));
    }

    public function testEscapeHtmlEntities(): void
    {
        $this->assertSame('a&amp;b&quot;', e('a&b"'));
    }

    public function testEscapeAmpersand(): void
    {
        $this->assertSame('2 &gt; 1', e('2 > 1'));
    }

    public function testEscapePreservesSafeText(): void
    {
        $this->assertSame('hello world', e('hello world'));
    }

    public function testEscapeJsString(): void
    {
        $result = eJS('test<script>quote</script>');
        $this->assertIsString($result);
        $decoded = json_decode($result, true);
        $this->assertSame('test<script>quote</script>', $decoded);
    }

    public function testEscapeJsReturnsJson(): void
    {
        $result = eJS('<b>ok</b>');
        $decoded = json_decode($result, true);
        $this->assertNotNull($decoded);
        $this->assertSame('<b>ok</b>', $decoded);
    }

    public function testEscapeJsWithUnicode(): void
    {
        $result = eJS('olá');
        $decoded = json_decode($result, true);
        $this->assertSame('olá', $decoded);
    }
}
