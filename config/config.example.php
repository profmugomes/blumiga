<?php
if (!defined('BLUMIGA')) exit;

// Ambiente de desenvolvimento - exibe erros na página (false em produção)
$blumigaDev = false;

// Caso tenha o BlumigaDB instalado
$dbConfig['default'] = [
 'server' => '',
 'username' => '',
 'password' => '',
 'database' => ''
];

// Será preenchido automaticamente ou defina o nome da sessão
$sessionName = '';

// Configurações de sessão
$sessionConfig = [
    'cookie_httponly'           => '1',
    'cookie_secure'            => '1',
    'cookie_samesite'          => 'Lax',
    'use_strict_mode'          => '1',
    'use_only_cookies'         => '1',
    'use_trans_sid'            => '0',
    'sid_length'               => '48',
    'sid_bits_per_character'   => '6',
];

// Headers de segurança (HTTP response headers)
$headersConfig = [
    'X-Content-Type-Options'       => 'nosniff',
    'X-Frame-Options'              => 'DENY',
    'Referrer-Policy'              => 'strict-origin-when-cross-origin',
    'Permissions-Policy'           => 'camera=(), microphone=(), geolocation=()',
    'Content-Security-Policy'      => "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; frame-ancestors 'none'",
    'Strict-Transport-Security'    => 'max-age=31536000; includeSubDomains',
    'X-XSS-Protection'            => '1; mode=block',
    'Cross-Origin-Opener-Policy'  => 'same-origin',
    'Cross-Origin-Resource-Policy' => 'same-origin',
];
