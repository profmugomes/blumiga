<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    public function testStrLimitShortStringUnchanged(): void
    {
        $this->assertSame('abc', str_limit('abc', 10));
    }

    public function testStrLimitLongStringTruncated(): void
    {
        $this->assertSame('abcde...', str_limit('abcdefghijklmn', 5));
    }

    public function testStrLimitCustomEnd(): void
    {
        $this->assertSame('abcde___', str_limit('abcdefghijklmn', 5, '___'));
    }

    public function testStrLimitExactLength(): void
    {
        $this->assertSame('abcde', str_limit('abcde', 5));
    }

    public function testStrAfterFound(): void
    {
        $this->assertSame('def', str_after('abc.def', '.'));
    }

    public function testStrAfterNotFound(): void
    {
        $this->assertSame('abc', str_after('abc', '.'));
    }

    public function testStrAfterMultipleOccurrences(): void
    {
        $this->assertSame('b.c', str_after('a.b.c', '.'));
    }

    public function testStrBeforeFound(): void
    {
        $this->assertSame('abc', str_before('abc.def', '.'));
    }

    public function testStrBeforeNotFound(): void
    {
        $this->assertSame('abc', str_before('abc', '.'));
    }

    public function testRemoveAccents(): void
    {
        $this->assertSame('acao', removeAccents('ação'));
        $this->assertSame('cafe', removeAccents('café'));
        $this->assertSame('numero', removeAccents('número'));
    }

    public function testRemoveSpecialChars(): void
    {
        $this->assertSame('abc', removeSpecialChars('a@b#c'));
        $this->assertSame('hello', removeSpecialChars('hello!@#$%'));
    }

    public function testGenerateSlug(): void
    {
        $this->assertSame('ola-mundo', generateSlug('Olá Mundo!'));
        $this->assertSame('php-e-incrivel', generateSlug('PHP é incrível'));
    }

    public function testPadNumberSingleDigit(): void
    {
        $this->assertSame('05', padNumber(5));
    }

    public function testPadNumberDoubleDigit(): void
    {
        $this->assertSame('12', padNumber(12));
    }

    public function testPadNumberTripleDigit(): void
    {
        $this->assertSame('123', padNumber(123));
    }

    public function testContainsAnyWithArray(): void
    {
        $this->assertTrue(containsAny('abc def', ['x', 'def']));
        $this->assertFalse(containsAny('abc def', ['x', 'y']));
    }

    public function testContainsAnyWithString(): void
    {
        $this->assertTrue(containsAny('abc def', 'def'));
        $this->assertFalse(containsAny('abc def', 'xyz'));
    }
}
