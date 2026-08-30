<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>🔧 Middleware</h1>
    <p class="doc-intro">
        Middlewares são filtros que interceptam requisições antes de chegarem aos controllers. 
        São úteis para autenticação, logs, validações e mais.
    </p>

    <section class="doc-section">
        <h2>📝 Assinatura</h2>
        <p>Todo middleware deve ter a seguinte assinatura:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/middleware/auth.php</span>

<span class="highlight">namespace</span> Blumiga\middleware\auth;

<span class="highlight">function</span> run(callable $next, mixed $param = null): <span class="highlight">void</span> {
    <span class="highlight">// Lógica do middleware</span>
    
    <span class="highlight">// Chama o próximo middleware ou controller</span>
    $next($param);
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>⛓️ Cadeia de Middlewares</h2>
        <p>Multiple middlewares são executados em sequência:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// Configuração das rotas</span>
routeGROUP('/admin', 'Admin', function () {
    routeGET('/', 'dashboard@index', 'admin.home');
}, ['auth@run', 'log@run']);

<span class="highlight">// Ordem de execução:</span>
<span class="highlight">// 1. auth@run (verifica autenticação)</span>
<span class="highlight">// 2. log@run (registra a requisição)</span>
<span class="highlight">// 3. dashboard@index (controller final)</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📁 Middlewares em Grupos</h2>
        <p>Aplique middlewares a grupos de rotas:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// Todos os endpoints admin passam por auth e log</span>
routeGROUP('/admin', 'Admin', function () {
    routeGET('/', 'dashboard@index', 'admin.home');
    routeGET('/usuarios', 'usuario@index', 'admin.usuarios');
    routePOST('/usuarios/salvar', 'usuario@salvar', 'admin.usuarios.salvar');
}, ['auth@run', 'log@run']);

<span class="highlight">// Rotas públicas (sem middleware)</span>
routeGET('/', 'home@index', 'home');
routeGET('/sobre', 'sobre@index', 'sobre');</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔐 Exemplo: Auth Middleware</h2>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/middleware/auth.php</span>

<span class="highlight">namespace</span> Blumiga\middleware\auth;

<span class="highlight">function</span> run(callable $next, mixed $param = null): <span class="highlight">void</span> {
    <span class="highlight">// Verificar se o usuário está logado</span>
    <span class="highlight">if</span> (!session('usuario_id')) {
        session('error', 'Você precisa estar logado');
        redirect('/login');
        <span class="highlight">return</span>;
    }
    
    <span class="highlight">// Usuário autenticado, prosseguir</span>
    $next($param);
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📝 Exemplo: Log Middleware</h2>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/middleware/log.php</span>

<span class="highlight">namespace</span> Blumiga\middleware\log;

<span class="highlight">function</span> run(callable $next, mixed $param = null): <span class="highlight">void</span> {
    $inicio = microtime(true);
    $uri = $_SERVER['REQUEST_URI'];
    $metodo = $_SERVER['REQUEST_METHOD'];
    
    <span class="highlight">// Chamar próximo middleware/controller</span>
    $next($param);
    
    <span class="highlight">// Calcular tempo de execução</span>
    $fim = microtime(true);
    $duracao = round(($fim - $inicio) * 1000, 2);
    
    <span class="highlight">// Registrar no log</span>
    $log = "[{$metodo}] {$uri} - {$duracao}ms\n";
    file_put_contents(LOGS_DIR . '/access.log', $log, FILE_APPEND);
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔧 Exemplo: Rate Limit</h2>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/middleware/ratelimit.php</span>

<span class="highlight">namespace</span> Blumiga\middleware\ratelimit;

<span class="highlight">function</span> run(callable $next, mixed $param = null): <span class="highlight">void</span> {
    $ip = $_SERVER['REMOTE_ADDR'];
    $chave = "rate_limit_{$ip}";
    $tentativas = session($chave) ?? 0;
    
    <span class="highlight">if</span> ($tentativas >= 60) {
        http_response_code(429);
        echo 'Muitas requisições. Tente novamente em 1 minuto.';
        <span class="highlight">return</span>;
    }
    
    <span class="highlight">// Incrementar contador</span>
    session($chave, $tentativas + 1);
    
    <span class="highlight">// Resetar a cada minuto</span>
    <span class="highlight">if</span> ($tentativas === 0) {
        session($chave . '_time', time());
    }
    
    $next($param);
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>💡 Dicas</h2>
        <ul class="doc-list">
            <li>Mantenha middlewares simples e focados em uma responsabilidade</li>
            <li>Sempre chame <code>$next($param)</code> para prosseguir ou retorne antes para bloquear</li>
            <li>Use middlewares para validações que se aplicam a múltiplas rotas</li>
            <li>Middleware de autenticação deve verificar a sessão e redirecionar se necessário</li>
        </ul>
    </section>
</div>
