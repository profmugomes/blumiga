<?php
// Model: Site
// Model para dados estáticos do site/documentação

namespace Blumiga\models\site;

if (!defined('BLUMIGA')) exit;

function getVersao(): string
{
    $composer = json_decode(file_get_contents(dirname(__DIR__, 2) . '/composer.json'), true);
    return $composer['version'] ?? 'alpha';
}

function getSecoes(): array
{
    return [
        ['url' => '/doc/instalacao', 'titulo' => 'Instalação', 'icone' => '📦', 'descricao' => 'Como instalar e configurar o BluMiga.'],
        ['url' => '/doc/rotas', 'titulo' => 'Rotas', 'icone' => '🗺️', 'descricao' => 'Sistema de rotas, grupos e parâmetros.'],
        ['url' => '/doc/controllers', 'titulo' => 'Controllers', 'icone' => '🎮', 'descricao' => 'Como criar e organizar controllers.'],
        ['url' => '/doc/views', 'titulo' => 'Views', 'icone' => '🎨', 'descricao' => 'Sistema de views e layouts.'],
        ['url' => '/doc/models', 'titulo' => 'Models', 'icone' => '💾', 'descricao' => 'Models e acesso a dados.'],
        ['url' => '/doc/middleware', 'titulo' => 'Middleware', 'icone' => '🛡️', 'descricao' => 'Autenticação, logs e validações.'],
        ['url' => '/doc/helpers', 'titulo' => 'Helpers', 'icone' => '🛠️', 'descricao' => 'Funções auxiliares do framework.'],
        ['url' => '/doc/cli', 'titulo' => 'CLI', 'icone' => '⌨️', 'descricao' => 'Comandos de linha de comando.'],
        ['url' => '/doc/seguranca', 'titulo' => 'Segurança', 'icone' => '🔒', 'descricao' => 'Boas práticas de segurança.'],
    ];
}
