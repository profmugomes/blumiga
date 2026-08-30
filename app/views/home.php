<?php if (!defined('BLUMIGA')) exit; ?>
<section class="hero">
    <h1>⚡ <span>BluMiga</span></h1>
    <p>Microframework MVC para PHP — Leve, rápido e procedural.</p>
    <a href="/doc/instalacao" class="hero-btn">🚀 Ver Documentação</a>
</section>

<section class="doc-content">
    <h2>Por que BluMiga?</h2>
    <div class="cards-grid">
        <div class="card">
            <span class="card-icon">🪶</span>
            <h3>Leveza</h3>
            <p>Extremamente leve e rápido. Sem dependências desnecessárias que sobrecarreguem seu projeto.</p>
        </div>
        <div class="card">
            <span class="card-icon">⚙️</span>
            <h3>Procedural</h3>
            <p>Código PHP procedural puro. Sem complexidade de POO desnecessária, direto ao ponto.</p>
        </div>
        <div class="card">
            <span class="card-icon">🧩</span>
            <h3>Modular</h3>
            <p>Arquitetura modular com controllers, models e middlewares fáceis de organizar.</p>
        </div>
        <div class="card">
            <span class="card-icon">⚡</span>
            <h3>Performance</h3>
            <p>Otimizado para máxima performance. Rotas rápidas e baixo consumo de memória.</p>
        </div>
    </div>

    <h2>Quick Start</h2>
    <div class="code-block">
        <code><span class="comment"># Instale via Composer</span>
composer create-project profmugomes/blumiga meu-projeto

<span class="comment"># Inicie o servidor de desenvolvimento</span>
php blumiga serve

<span class="comment"># Acesse no navegador</span>
http://localhost:8080</code>
    </div>

    <h2>Exemplo Rápido</h2>
    <h3>Rotas</h3>
    <div class="code-block">
        <code><span class="comment">// config/routes.php</span>
<span class="function">routeGET</span>(<span class="string">'/'</span>, <span class="string">'home@index'</span>, <span class="string">'home'</span>);
<span class="function">routeGET</span>(<span class="string">'/produto/{id}'</span>, <span class="string">'produto@show'</span>, <span class="string">'produto.show'</span>);
<span class="function">routePOST</span>(<span class="string">'/login'</span>, <span class="string">'auth@logar'</span>, <span class="string">'login.logar'</span>);</code>
    </div>

    <h3>Controller</h3>
    <div class="code-block">
        <code><span class="keyword">&lt;?php</span>
<span class="keyword">namespace</span> Blumiga\controllers\home;

<span class="keyword">function</span> <span class="function">index</span>(): <span class="keyword">void</span> {
    <span class="function">view</span>(<span class="string">'home'</span>, [
        <span class="string">'titulo'</span> => <span class="string">'Bem-vindo ao BluMiga'</span>
    ], <span class="string">'layout'</span>);
}</code>
    </div>

    <div class="cards-grid" style="margin-top: 2rem;">
        <a href="/doc/instalacao" class="card">
            <span class="card-icon">📦</span>
            <h3>Instalação</h3>
            <p>Como instalar e configurar o BluMiga no seu projeto.</p>
        </a>
        <a href="/doc/rotas" class="card">
            <span class="card-icon">🗺️</span>
            <h3>Rotas</h3>
            <p>Sistema de rotas, grupos e parâmetros.</p>
        </a>
        <a href="/doc/controllers" class="card">
            <span class="card-icon">🎮</span>
            <h3>Controllers</h3>
            <p>Como criar e organizar controllers.</p>
        </a>
        <a href="/doc/views" class="card">
            <span class="card-icon">🎨</span>
            <h3>Views</h3>
            <p>Sistema de views e layouts.</p>
        </a>
        <a href="/doc/helpers" class="card">
            <span class="card-icon">🛠️</span>
            <h3>Helpers</h3>
            <p>Funções auxiliares do framework.</p>
        </a>
        <a href="/doc/cli" class="card">
            <span class="card-icon">⌨️</span>
            <h3>CLI</h3>
            <p>Comandos de linha de comando.</p>
        </a>
    </div>
</section>
