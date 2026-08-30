<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>📖 Documentação BluMiga</h1>
    <p class="doc-intro">
        Bem-vindo à documentação oficial do BluMiga. Aqui você encontrará tudo o que precisa 
        para começar a desenvolver com nosso microframework MVC procedural.
    </p>

    <div class="card-grid">
        <a href="/doc/instalacao" class="card card-link">
            <div class="card-icon">📦</div>
            <h3>Instalação</h3>
            <p>Pré-requisitos, instalação via Composer e configuração inicial do projeto.</p>
            <span class="badge">Comece aqui</span>
        </a>

        <a href="/doc/rotas" class="card card-link">
            <div class="card-icon">🛤️</div>
            <h3>Rotas</h3>
            <p>Defina rotas GET, POST, parâmetros, grupos e rotas nomeadas.</p>
            <span class="badge badge-get">GET</span>
            <span class="badge badge-post">POST</span>
        </a>

        <a href="/doc/controllers" class="card card-link">
            <div class="card-icon">🎮</div>
            <h3>Controllers</h3>
            <p>Organize sua lógica de negócio com controllers funcionais usando namespaces.</p>
        </a>

        <a href="/doc/views" class="card card-link">
            <div class="card-icon">🎨</div>
            <h3>Views</h3>
            <p>Sistema de templates com suporte a layouts e escape XSS automático.</p>
        </a>

        <a href="/doc/models" class="card card-link">
            <div class="card-icon">💾</div>
            <h3>Models</h3>
            <p>Crie models para interagir com bancos de dados de forma simples e procedural.</p>
        </a>

        <a href="/doc/middleware" class="card card-link">
            <div class="card-icon">🔧</div>
            <h3>Middleware</h3>
            <p>Filtros e interceptadores para autenticação, logs e validações.</p>
        </a>

        <a href="/doc/helpers" class="card card-link">
            <div class="card-icon">🛠️</div>
            <h3>Helpers</h3>
            <p>Funções utilitárias para escape, redirecionamento, sessões e mais.</p>
        </a>

        <a href="/doc/cli" class="card card-link">
            <div class="card-icon">⌨️</div>
            <h3>CLI</h3>
            <p>Comandos de terminal para gerar código, rodar migrations e muito mais.</p>
        </a>

        <a href="/doc/seguranca" class="card card-link">
            <div class="card-icon">🔒</div>
            <h3>Segurança</h3>
            <p>Headers HTTP, proteção CSRF, XSS prevention e criptografia AES-256.</p>
        </a>
    </div>
</div>
