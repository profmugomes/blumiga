<?php
// Controller: Doc
// Gerado pelo Blumiga CLI e customizado

namespace Blumiga\controllers\doc;

function index(): void
{
    view('doc/index', [
        'titulo' => 'Documentação BluMiga',
        'currentPage' => '/doc'
    ], 'layout');
}

function instalacao(): void
{
    view('doc/instalacao', [
        'titulo' => 'Instalação — BluMiga',
        'currentPage' => '/doc/instalacao'
    ], 'layout');
}

function rotas(): void
{
    view('doc/rotas', [
        'titulo' => 'Rotas — BluMiga',
        'currentPage' => '/doc/rotas'
    ], 'layout');
}

function controllers(): void
{
    view('doc/controllers', [
        'titulo' => 'Controllers — BluMiga',
        'currentPage' => '/doc/controllers'
    ], 'layout');
}

function views(): void
{
    view('doc/views', [
        'titulo' => 'Views — BluMiga',
        'currentPage' => '/doc/views'
    ], 'layout');
}

function models(): void
{
    view('doc/models', [
        'titulo' => 'Models — BluMiga',
        'currentPage' => '/doc/models'
    ], 'layout');
}

function middleware(): void
{
    view('doc/middleware', [
        'titulo' => 'Middleware — BluMiga',
        'currentPage' => '/doc/middleware'
    ], 'layout');
}

function helpers(): void
{
    view('doc/helpers', [
        'titulo' => 'Helpers — BluMiga',
        'currentPage' => '/doc/helpers'
    ], 'layout');
}

function cli(): void
{
    view('doc/cli', [
        'titulo' => 'CLI — BluMiga',
        'currentPage' => '/doc/cli'
    ], 'layout');
}

function seguranca(): void
{
    view('doc/seguranca', [
        'titulo' => 'Segurança — BluMiga',
        'currentPage' => '/doc/seguranca'
    ], 'layout');
}
