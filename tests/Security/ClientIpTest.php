<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ClientIpTest extends TestCase
{
    protected function setUp(): void
    {
        unset($_SERVER['HTTP_CF_CONNECTING_IP']);
        unset($_SERVER['HTTP_X_FORWARDED_FOR']);
        unset($_SERVER['REMOTE_ADDR']);
        if (defined('BLUMIGA_TRUSTED_PROXY')) {
            $this->markTestSkipped('BLUMIGA_TRUSTED_PROXY já definido');
        }
    }

    public function testDefaultRemoteAddr(): void
    {
        $_SERVER['REMOTE_ADDR'] = '0.0.0.0';
        $this->assertSame('0.0.0.0', getClientIP());
    }

    public function testCloudflareIpHasPriority(): void
    {
        $_SERVER['REMOTE_ADDR'] = '0.0.0.0';
        $_SERVER['HTTP_CF_CONNECTING_IP'] = '100.100.100.100';
        $this->assertSame('100.100.100.100', getClientIP());
    }

    public function testCloudflareInvalidIpIgnored(): void
    {
        $_SERVER['REMOTE_ADDR'] = '0.0.0.0';
        $_SERVER['HTTP_CF_CONNECTING_IP'] = 'not-an-ip';
        $this->assertSame('0.0.0.0', getClientIP());
    }

    public function testFallbackToRemoteAddr(): void
    {
        $this->assertSame('127.0.0.1', getClientIP());
    }
}
