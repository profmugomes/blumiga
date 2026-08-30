<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class SessionHelperTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
    }

    public function testSessionSetAndGet(): void
    {
        sessionSet('test_key', 'test_value');
        $this->assertSame('test_value', sessionGet('test_key'));
    }

    public function testSessionGetDefault(): void
    {
        $this->assertSame('default', sessionGet('nonexistent', 'default'));
    }

    public function testSessionGetNullDefault(): void
    {
        $this->assertNull(sessionGet('nonexistent'));
    }

    public function testSessionRemove(): void
    {
        sessionSet('to_remove', 'value');
        sessionRemove('to_remove');
        $this->assertNull(sessionGet('to_remove'));
    }

    public function testSessionReturnsAll(): void
    {
        sessionSet('a', 1);
        sessionSet('b', 2);
        $all = session();
        $this->assertIsArray($all);
        $this->assertSame(1, $all['a']);
        $this->assertSame(2, $all['b']);
    }

    public function testSessionNullReturnsAll(): void
    {
        $all = session(null);
        $this->assertIsArray($all);
    }

    public function testSessionOverwrite(): void
    {
        sessionSet('key', 'first');
        sessionSet('key', 'second');
        $this->assertSame('second', sessionGet('key'));
    }

    public function testSessionMixedTypes(): void
    {
        sessionSet('string', 'text');
        sessionSet('int', 42);
        sessionSet('array', [1, 2, 3]);
        $this->assertSame('text', sessionGet('string'));
        $this->assertSame(42, sessionGet('int'));
        $this->assertSame([1, 2, 3], sessionGet('array'));
    }
}
