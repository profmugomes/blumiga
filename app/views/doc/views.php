<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>🎨 Views</h1>
    <p class="doc-intro">
        O sistema de views do BluMiga permite criar templates HTML com suporte a layouts 
        e escape XSS automático para segurança.
    </p>

    <section class="doc-section">
        <h2>📝 Renderizando Views</h2>
        <p>Use a função <code>view()</code> para renderizar uma view:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// Renderiza app/views/home/index.php</span>
view('home/index');

<span class="highlight">// Passa dados para a view</span>
$titulo = 'Minha Página';
$conteudo = 'Olá mundo!';
view('home/index', compact('titulo', 'conteudo'));

<span class="highlight">// Usa um layout específico</span>
view('home/index', $data, 'admin');</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📐 Sistema de Layouts</h2>
        <p>O layout principal é <code>app/views/layout.php</code>. Ele contém a estrutura HTML base:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// layout.php</span>
?&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="pt-BR"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;&lt;?= e($pageTitle ?? 'BluMiga') ?&gt;&lt;/title&gt;
    &lt;link rel="stylesheet" href="/assets/css/style.css"&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;aside class="sidebar"&gt;
        <span class="highlight">&lt;!-- Menu de navegação --&gt;</span>
    &lt;/aside&gt;
    
    &lt;main class="main-content"&gt;
        &lt;?= $content ?&gt;  <span class="highlight">&lt;!-- Conteúdo da view será inserido aqui --&gt;</span>
    &lt;/main&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔒 Escape XSS com e()</h2>
        <p>Use a função <code>e()</code> para escapar variáveis e prevenir ataques XSS:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">&lt;!-- INCORRETO - vulnerável a XSS --&gt;</span>
&lt;h1&gt;&lt;?= $titulo ?&gt;&lt;/h1&gt;
&lt;p&gt;&lt;?= $conteudo ?&gt;&lt;/p&gt;

<span class="highlight">&lt;!-- CORRETO - com escape --&gt;</span>
&lt;h1&gt;&lt;?= e($titulo) ?&gt;&lt;/h1&gt;
&lt;p&gt;&lt;?php echo e($conteudo) ?&gt;&lt;/p&gt;</code></pre>
        </div>

        <div class="alert alert-warning">
            <strong>⚠️ Importante:</strong> Sempre use <code>e()</code> para exibir dados do usuário ou dados vindos de banco de dados.
        </div>
    </section>

    <section class="doc-section">
        <h2>📦 Variáveis Disponíveis</h2>
        <p>As variáveis passadas via <code>compact()</code> ou array estão disponíveis na view:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// No controller</span>
$usuarios = model('usuario')->listar();
$total = count($usuarios);
view('usuario/lista', compact('usuarios', 'total'));

<span class="highlight">// Na view (usuario/lista.php)</span>
?&gt;
&lt;h1&gt;Usuários (&lt;?= e($total) ?&gt;)&lt;/h1&gt;
&lt;ul&gt;
&lt;?php foreach ($usuarios as $usuario): ?&gt;
    &lt;li&gt;&lt;?= e($usuario['nome']) ?&gt;&lt;/li&gt;
&lt;?php endforeach; ?&gt;
&lt;/ul&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📋 Exemplo Completo</h2>
        
        <h3>Controller:</h3>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/controllers/home.php</span>

<span class="highlight">namespace</span> Blumiga\controllers\home;

<span class="highlight">function</span> index(): <span class="highlight">void</span> {
    $pageTitle = 'Início';
    $mensagem = 'Bem-vindo ao BluMiga!';
    $features = ['Leve', 'Rápido', 'Simples'];
    
    view('home/index', compact('pageTitle', 'mensagem', 'features'));
}</code></pre>
        </div>

        <h3>View:</h3>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/views/home/index.php</span>
if (!defined('BLUMIGA')) exit;
?&gt;
&lt;div class="doc-content"&gt;
    &lt;h1&gt;&lt;?= e($mensagem) ?&gt;&lt;/h1&gt;
    
    &lt;h2&gt;Features:&lt;/h2&gt;
    &lt;ul&gt;
    &lt;?php foreach ($features as $feature): ?&gt;
        &lt;li&gt;&lt;?= e($feature) ?&gt;&lt;/li&gt;
    &lt;?php endforeach; ?&gt;
    &lt;/ul&gt;
&lt;/div&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>💡 Dicas</h2>
        <ul class="doc-list">
            <li>Sempre comece a view com <code>if (!defined('BLUMIGA')) exit;</code></li>
            <li>Use <code>e()</code> em TODAS as variáveis que vêm do usuário ou banco</li>
            <li>Mantenha lógica complexa nos controllers, não nas views</li>
            <li>Use partials para componentes reutilizáveis</li>
        </ul>
    </section>
</div>
