<?php
// Copyright (C) 2026 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Site: https://www.bluice.com.br

// Servir arquivos estáticos no PHP built-in server (php -S)
$blumiga_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$blumiga_realFile = __DIR__ . $blumiga_uri;
if ($blumiga_uri !== '/' && file_exists($blumiga_realFile) && is_file($blumiga_realFile)) {
    return false;
}

if (ini_get('zlib.output_compression') === '0' || ini_get('zlib.output_compression') === 'Off') {
    if (extension_loaded('zlib')) {
        ob_start('ob_gzhandler');
    }
}

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set("America/Sao_Paulo");

define('BLUMIGA', true);

require_once(dirname(__FILE__, 2) . '/config/config.php');

// Headers de Segurança (configuráveis via config.php)
if (!empty($headersConfig) && is_array($headersConfig)) {
    $allowedHeaders = [
        'X-Content-Type-Options', 'X-Frame-Options', 'Referrer-Policy',
        'Permissions-Policy', 'Content-Security-Policy', 'Strict-Transport-Security',
        'X-XSS-Protection', 'Cross-Origin-Opener-Policy', 'Cross-Origin-Resource-Policy',
    ];
    foreach ($headersConfig as $headerName => $headerValue) {
        if (in_array($headerName, $allowedHeaders, true)
            && is_string($headerValue)
            && strpos($headerValue, "\r") === false
            && strpos($headerValue, "\n") === false
        ) {
            header("{$headerName}: {$headerValue}");
        }
    }
}

// Configurações seguras de sessão (configuráveis via config.php)
if (!empty($sessionConfig) && is_array($sessionConfig)) {
    foreach ($sessionConfig as $iniKey => $iniValue) {
        ini_set('session.' . $iniKey, $iniValue);
    }
}

if (empty($sessionName)) {
    session_name('blumiga_session');
} else {
    session_name($sessionName);
}
session_start();

require_once(dirname(__FILE__, 2) . '/core/app.php');
