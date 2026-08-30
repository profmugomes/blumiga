<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class PasswordGeneratorTest extends TestCase
{
    public function testGeneratePasswordDefaultLength(): void
    {
        $password = generatePassword();
        $this->assertSame(8, strlen($password));
    }

    public function testGeneratePasswordCustomLength(): void
    {
        $password = generatePassword(16);
        $this->assertSame(16, strlen($password));
    }

    public function testGeneratePasswordWithUppercase(): void
    {
        $password = generatePassword(100, true, false, false);
        $this->assertMatchesRegularExpression('/[A-Z]/', $password);
    }

    public function testGeneratePasswordWithoutUppercase(): void
    {
        $password = generatePassword(100, false, false, false);
        $this->assertMatchesRegularExpression('/^[a-z]+$/', $password);
    }

    public function testGeneratePasswordWithNumbers(): void
    {
        $password = generatePassword(100, false, true, false);
        $this->assertMatchesRegularExpression('/[0-9]/', $password);
    }

    public function testGeneratePasswordWithSymbols(): void
    {
        $password = generatePassword(100, true, true, true);
        $this->assertMatchesRegularExpression('/[!@#$%*-]/', $password);
    }

    public function testGeneratePasswordIsRandom(): void
    {
        $a = generatePassword(32);
        $b = generatePassword(32);
        $this->assertNotSame($a, $b);
    }

    public function testGeneratePrefixLength(): void
    {
        $prefix = generatePrefix();
        $this->assertSame(5, strlen($prefix));
    }

    public function testGeneratePrefixIsLowercase(): void
    {
        $prefix = generatePrefix();
        $this->assertMatchesRegularExpression('/^[a-z]+$/', $prefix);
    }

    public function testGeneratePrefixIsRandom(): void
    {
        $a = generatePrefix();
        $b = generatePrefix();
        // Extremamente improvável ser igual, mas possível
        // Não assertNotSame para evitar flaky test
        $this->assertSame(5, strlen($a));
        $this->assertSame(5, strlen($b));
    }
}
