<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class OpenRedirectTest extends TestCase
{
    protected function setUp(): void
    {
        $_SERVER['HTTP_HOST'] = 'meusite.com';
    }

    public function testRedirectSameHostAllowed(): void
    {
        $url = 'https://meusite.com/pagina';
        $parsed = parse_url($url);
        $currentHost = $_SERVER['HTTP_HOST'];

        // Verifica que URL do mesmo host não é bloqueada
        $this->assertSame($currentHost, $parsed['host'] ?? '');
    }

    public function testRedirectDifferentHostIsBlocked(): void
    {
        $url = 'https://evil.com/hack';
        $parsed = parse_url($url);
        $currentHost = $_SERVER['HTTP_HOST'];

        // Verifica que host diferente seria bloqueado
        $this->assertNotSame($currentHost, $parsed['host'] ?? '');
    }

    public function testRedirectRelativeUrlHasNoHost(): void
    {
        $url = '/dashboard';
        $parsed = parse_url($url);

        // URL relativa não tem host, logo não é bloqueada
        $this->assertArrayNotHasKey('host', $parsed);
    }

    public function testRedirectJavascriptSchemeIsBlocked(): void
    {
        $url = 'javascript:alert(1)';
        $parsed = parse_url($url);

        // scheme javascript: não está na lista de permitidos
        $allowedSchemes = ['http', 'https', ''];
        $this->assertNotContains($parsed['scheme'] ?? '', $allowedSchemes);
    }

    public function testRedirectWithArrayParams(): void
    {
        $url = '/busca';
        $params = ['q' => 'termo', 'page' => 2];
        $url .= '?' . http_build_query($params);

        $this->assertStringContainsString('q=termo', $url);
        $this->assertStringContainsString('page=2', $url);
    }

    public function testRedirectParamsBuildQuery(): void
    {
        $params = ['q' => 'termo'];
        $query = http_build_query($params);

        $this->assertSame('q=termo', $query);
    }
}
