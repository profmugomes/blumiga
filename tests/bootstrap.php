<?php
// Bootstrap para testes do BluMiga
define('BLUMIGA', true);

// Autoload do Composer
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Incluir funções e rotas do core
require_once dirname(__DIR__) . '/core/functions.php';
require_once dirname(__DIR__) . '/core/route.php';

// Iniciar sessão para testes que precisam
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
