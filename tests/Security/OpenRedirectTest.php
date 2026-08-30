<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class OpenRedirectTest extends TestCase
{
    protected function setUp(): void
    {
        $_SERVER['HTTP_HOST'] = 'teste.localhost';
    }

    /**
     * Reproduz a lógica de validação do redirect() sem chamar exit.
     */
    private function simulateRedirect(string $url): string
    {
        $parsed = parse_url($url);
        $currentHost = $_SERVER['HTTP_HOST'] ?? 'localhost';

        if (isset($parsed['host']) && $parsed['host'] !== $currentHost) {
            return '/';
        }

        if (isset($parsed['scheme']) && !in_array($parsed['scheme'], ['http', 'https', ''], true)) {
            return '/';
        }

        return $url;
    }

    public function testRedirectSameHostAllowed(): void
    {
        $url = 'https://teste.localhost/pagina';
        $result = $this->simulateRedirect($url);
        $this->assertSame($url, $result);
    }

    public function testRedirectDifferentHostIsBlocked(): void
    {
        $url = 'https://teste.localhost.atacante/hack';
        $result = $this->simulateRedirect($url);
        $this->assertSame('/', $result);
    }

    public function testRedirectExternalHostIsBlocked(): void
    {
        $url = 'https://externo teste.localhost/falso';
        $result = $this->simulateRedirect($url);
        $this->assertSame('/', $result);
    }

    public function testRedirectRelativeUrlAllowed(): void
    {
        $url = '/dashboard';
        $result = $this->simulateRedirect($url);
        $this->assertSame($url, $result);
    }

    public function testRedirectRelativeWithParamsAllowed(): void
    {
        $url = '/busca?q=termo&page=2';
        $result = $this->simulateRedirect($url);
        $this->assertSame($url, $result);
    }

    public function testRedirectJavascriptSchemeIsBlocked(): void
    {
        $url = 'javascript:alert(1)';
        $result = $this->simulateRedirect($url);
        $this->assertSame('/', $result);
    }

    public function testRedirectDataSchemeIsBlocked(): void
    {
        $url = 'data:text/html,<script>alert(1)</script>';
        $result = $this->simulateRedirect($url);
        $this->assertSame('/', $result);
    }

    public function testRedirectParamsBuildQuery(): void
    {
        $params = ['q' => 'termo'];
        $query = http_build_query($params);
        $this->assertSame('q=termo', $query);
    }
}
