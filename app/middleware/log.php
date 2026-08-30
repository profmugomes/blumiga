<?php
// Middleware: log
// Gerado em: 2026-08-30 17:34:33

namespace Blumiga\middleware\log;

if (!defined('BLUMIGA')) exit;

function run(callable $next, mixed $param = null): void {
    $next();
}
