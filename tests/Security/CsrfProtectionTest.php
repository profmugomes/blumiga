<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CsrfProtectionTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['csrf_token']);
    }

    public function testTokenIsGenerated(): void
    {
        $token = csrf_token();
        $this->assertIsString($token);
        $this->assertNotEmpty($token);
    }

    public function testTokenHas64Characters(): void
    {
        $token = csrf_token();
        $this->assertSame(64, strlen($token));
    }

    public function testTokenIsHexadecimal(): void
    {
        $token = csrf_token();
        $this->assertMatchesRegularExpression('/^[a-f0-9]+$/', $token);
    }

    public function testTokenSameOnSecondCall(): void
    {
        $first = csrf_token();
        $second = csrf_token();
        $this->assertSame($first, $second);
    }

    public function testVerifyWithValidToken(): void
    {
        $token = csrf_token();
        $this->assertTrue(csrf_verify($token));
    }

    public function testVerifyWithInvalidToken(): void
    {
        csrf_token();
        $this->assertFalse(csrf_verify('wrong-token'));
    }

    public function testVerifyWithNullToken(): void
    {
        csrf_token();
        $this->assertFalse(csrf_verify(null));
    }

    public function testVerifyWithEmptyToken(): void
    {
        csrf_token();
        $this->assertFalse(csrf_verify(''));
    }

    public function testCsrfFieldContainsToken(): void
    {
        $token = csrf_token();
        $field = csrf_field();
        $this->assertStringContainsString('csrf_token', $field);
        $this->assertStringContainsString($token, $field);
        $this->assertStringContainsString('type="hidden"', $field);
    }

    public function testCsrfFieldIsHtmlInput(): void
    {
        $field = csrf_field();
        $this->assertStringContainsString('<input', $field);
        $this->assertStringContainsString('name="csrf_token"', $field);
    }
}
