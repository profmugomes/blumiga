<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class DateHelperTest extends TestCase
{
    public function testChangeDateDefaultFormats(): void
    {
        $this->assertSame('2026-08-30', changeDate('30/08/2026'));
    }

    public function testChangeDateCustomFormats(): void
    {
        $this->assertSame('2026/08/30', changeDate('30-08-2026', 'd-m-Y', 'Y/m/d'));
    }

    public function testChangeDateInvalidReturnsEmpty(): void
    {
        $this->assertSame('', changeDate('data-invalida'));
    }

    public function testChangeDateFromYmdToDmy(): void
    {
        $this->assertSame('30/08/2026', changeDate('2026-08-30', 'Y-m-d', 'd/m/Y'));
    }
}
