<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>🛤️ Rotas</h1>
    <p class="doc-intro">
        O BluMiga oferece um sistema de rotas simples e flexível para mapear URLs para controllers.
    </p>

    <section class="doc-section">
        <h2>📝 Definindo Rotas</h2>
        <p>As rotas são definidas no arquivo <code>config/routes.php</code>.</p>
        
        <h3>Rotas GET</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Rota simples</span>
routeGET('/', 'home@index', 'home');

<span class="highlight"># Rota com parâmetro</span>
routeGET('/usuario/{id}', 'usuario@show', 'usuario.show');

<span class="highlight"># Rota com regex no parâmetro</span>
routeGET('/produto/{id:[0-9]+}', 'produto@show', 'produto.show');</code></pre>
        </div>

        <h3>Rotas POST</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Rota para formulário</span>
routePOST('/contato', 'contato@enviar', 'contato.enviar');

<span class="highlight"># Rota de login</span>
routePOST('/login', 'auth@logar', 'auth.logar');</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🎯 Parâmetros de Rota</h2>
        <p>Use chaves <code>{}</code> para definir parâmetros dinâmicos:</p>
        
        <table class="doc-table">
            <thead>
                <tr>
                    <th>Padrão</th>
                    <th>Descrição</th>
                    <th>Exemplo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>{id}</code></td>
                    <td>Parâmetro simples</td>
                    <td>/usuario/123</td>
                </tr>
                <tr>
                    <td><code>{id:[0-9]+}</code></td>
                    <td>Parâmetro com regex</td>
                    <td>/produto/42 (apenas números)</td>
                </tr>
                <tr>
                    <td><code>{slug:[a-z-]+}</code></td>
                    <td>Parâmetro com padrão</td>
                    <td>/post/meu-artigo</td>
                </tr>
            </tbody>
        </table>

        <div class="code-block">
            <pre><code><span class="highlight">// Definição da rota</span>
routeGET('/post/{slug:[a-z-]+}', 'post@show', 'post.show');

<span class="highlight">// No controller, acesse o parâmetro:</span>
function show($slug) {
    <span class="highlight">// $slug contém o valor da URL</span>
    echo "Post: " . $slug;
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🏷️ Rotas Nomeadas</h2>
        <p>Nomeie suas rotas para referenciá-las facilmente:</p>
        <div class="code-block">
            <pre><code><span class="highlight"># Defina um nome para a rota</span>
routeGET('/dashboard', 'dashboard@index', 'dashboard');

<span class="highlight"># Use o nome em redirecionamentos</span>
redirect(route('dashboard'));</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📁 Grupos de Rotas</h3>
        <p>Agrupe rotas com middlewares e prefixos:</p>
        <div class="code-block">
            <pre><code>routeGROUP('/admin', 'Admin', function () {
    routeGET('/', 'dashboard@index', 'admin.home');
    routeGET('/usuarios', 'usuario@index', 'admin.usuarios');
    routePOST('/usuarios/salvar', 'usuario@salvar', 'admin.usuarios.salvar');
}, ['auth@run', 'log@run']);</code></pre>
        </div>
        <p>Isso cria rotas como <code>/admin/</code>, <code>/admin/usuarios</code>, etc.</p>
    </section>

    <section class="doc-section">
        <h2>🚫 Rota 404</h2>
        <p>Defina uma página personalizada para quando a rota não for encontrada:</p>
        <div class="code-block">
            <pre><code>route404(function () {
    view('errors/404');
});</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📋 Exemplo Completo</h2>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// config/routes.php</span>

<span class="highlight">// Rotas públicas</span>
routeGET('/', 'home@index', 'home');
routeGET('/sobre', 'sobre@index', 'sobre');
routeGET('/contato', 'contato@index', 'contato');
routePOST('/contato/enviar', 'contato@enviar', 'contato.enviar');

<span class="highlight">// Rotas de autenticação</span>
routeGET('/login', 'auth@login', 'login');
routePOST('/login', 'auth@logar', 'login.logar');
routeGET('/logout', 'auth@logout', 'logout');

<span class="highlight">// Rotas protegidas (admin)</span>
routeGROUP('/admin', 'Admin', function () {
    routeGET('/', 'dashboard@index', 'admin.home');
    routeGET('/config', 'config@index', 'admin.config');
}, ['auth@run']);

<span class="highlight">// Rota 404</span>
route404(function () {
    view('errors/404');
});</code></pre>
        </div>
    </section>
</div>
