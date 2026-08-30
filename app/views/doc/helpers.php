<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>🛠️ Helpers</h1>
    <p class="doc-intro">
        O BluMiga fornece funções utilitárias (helpers) para facilitar tarefas comuns no desenvolvimento.
    </p>

    <section class="doc-section">
        <h2>🔒 Segurança</h2>
        
        <h3>e() - Escape HTML</h3>
        <p>Escapa variáveis para prevenir ataques XSS:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Escape simples</span>
$seguro = e($variavelDoUsuario);

<span class="highlight">// Uso em views</span>
&lt;h1&gt;&lt;?= e($titulo) ?&gt;&lt;/h1&gt;
&lt;p&gt;&lt;?= e($conteudo) ?&gt;&lt;/p&gt;</code></pre>
        </div>

        <h3>eJS() - Escape JavaScript</h3>
        <p>Escapa variáveis para uso seguro em código JavaScript:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Em uma view</span>
&lt;script&gt;
    var titulo = '&lt;?= eJS($titulo) ?&gt;';
    var dados = &lt;?= eJS(json_encode($dados)) ?&gt;;
&lt;/script&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔄 Redirecionamento</h2>
        
        <h3>redirect()</h3>
        <p>Redireciona o usuário para outra URL:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Redirecionar para URL</span>
redirect('/usuarios');

<span class="highlight">// Redirecionar com mensagem</span>
redirect('/login', 'Você precisa estar logado');

<span class="highlight">// Redirecionar para rota nomeada</span>
redirect(route('dashboard'));</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📦 Sessão</h2>
        
        <h3>session()</h3>
        <p>Gerencia dados da sessão do usuário:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Definir valor na sessão</span>
session('usuario_id', 123);
session('usuario_nome', 'João');

<span class="highlight">// Obter valor da sessão</span>
$id = session('usuario_id');

<span class="highlight">// Obter com valor padrão</span>
$nome = session('usuario_nome', 'Visitante');

<span class="highlight">// Verificar se existe</span>
<span class="highlight">if</span> (session('logado')) {
    <span class="highlight">// Usuário está logado</span>
}

<span class="highlight">// Remover da sessão</span>
session('usuario_id', null);</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📝 Formulários</h2>
        
        <h3>inputGET() e inputPOST()</h3>
        <p>Obtém dados de formulários de forma segura:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Obter dados do POST</span>
$nome = inputPOST('nome');
$email = inputPOST('email');

<span class="highlight">// Obter dados do GET</span>
$pagina = inputGET('page') ?? 1;
$busca = inputGET('q');

<span class="highlight">// Uso em formulário</span>
&lt;form method="POST" action="/contato"&gt;
    &lt;input type="text" name="nome" 
           value="&lt;?= e(inputPOST('nome')) ?&gt;"&gt;
    &lt;input type="email" name="email" 
           value="&lt;?= e(inputPOST('email')) ?&gt;"&gt;
&lt;/form&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔐 Criptografia</h2>
        
        <h3>encrypt() e decrypt()</h3>
        <p>Criptografa e descriptografa dados usando AES-256-CBC:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Criptografar dados</span>
$sensivel = 'Informação secreta';
$criptografado = encrypt($sensivel);

<span class="highlight">// Descriptografar dados</span>
$original = decrypt($criptografado);

<span class="highlight">// Uso prático</span>
<span class="highlight">// Salvar token criptografado</span>
$token = encrypt($dadosSensiveis);
db()->update('usuarios', ['token' => $token], ['id' => $id]);

<span class="highlight">// Recuperar e descriptografar</span>
$usuario = db()->select('usuarios', '*', ['id' => $id]);
$token = decrypt($usuario['token']);</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🎲 Geração de Dados</h2>
        
        <h3>generatePassword()</h3>
        <p>Gera senhas seguras aleatórias:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Gerar senha de 16 caracteres</span>
$senha = generatePassword(16);

<span class="highlight">// Gerar senha padrão (32 caracteres)</span>
$senha = generatePassword();</code></pre>
        </div>

        <h3>generateSlug()</h3>
        <p>Gera slugs amigáveis para URLs:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Gerar slug de texto</span>
$slug = generateSlug('Olá Mundo! Este é um Post');
<span class="highlight">// Resultado: "ola-mundo-este-e-um-post"</span>

<span class="highlight">// Uso em posts</span>
 titulo = inputPOST('titulo');
$slug = generateSlug($titulo);
db()->insert('posts', ['titulo' => $titulo, 'slug' => $slug]);</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📁 Assets</h2>
        
        <h3>asset()</h3>
        <p>Gera URLs para assets com versionamento (cache busting):</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Gera URL com versão baseada no timestamp</span>
$cssUrl = asset('css/style.css');
<span class="highlight">// Resultado: /assets/css/style.css?v=1693420800</span>

$jsUrl = asset('js/app.js');
<span class="highlight">// Resultado: /assets/js/app.js?v=1693420800</span>

<span class="highlight">// Uso em views</span>
&lt;link rel="stylesheet" href="&lt;?= asset('css/style.css') ?&gt;"&gt;
&lt;script src="&lt;?= asset('js/app.js') ?&gt;"&gt;&lt;/script&gt;
&lt;img src="&lt;?= asset('images/logo.png') ?&gt;" alt="Logo"&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📋 Referência Rápida</h2>
        <table class="doc-table">
            <thead>
                <tr>
                    <th>Função</th>
                    <th>Descrição</th>
                    <th>Exemplo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>e($var)</code></td>
                    <td>Escape HTML (XSS)</td>
                    <td><code>e($nome)</code></td>
                </tr>
                <tr>
                    <td><code>eJS($var)</code></td>
                    <td>Escape JavaScript</td>
                    <td><code>eJS($dados)</code></td>
                </tr>
                <tr>
                    <td><code>redirect($url)</code></td>
                    <td>Redirecionamento</td>
                    <td><code>redirect('/home')</code></td>
                </tr>
                <tr>
                    <td><code>session($key, $val)</code></td>
                    <td>Gerenciar sessão</td>
                    <td><code>session('user')</code></td>
                </tr>
                <tr>
                    <td><code>inputPOST($key)</code></td>
                    <td>Dados POST</td>
                    <td><code>inputPOST('nome')</code></td>
                </tr>
                <tr>
                    <td><code>inputGET($key)</code></td>
                    <td>Dados GET</td>
                    <td><code>inputGET('page')</code></td>
                </tr>
                <tr>
                    <td><code>encrypt($data)</code></td>
                    <td>Criptografar</td>
                    <td><code>encrypt($sensivel)</code></td>
                </tr>
                <tr>
                    <td><code>decrypt($data)</code></td>
                    <td>Descriptografar</td>
                    <td><code>decrypt($cript)</code></td>
                </tr>
                <tr>
                    <td><code>generatePassword()</code></td>
                    <td>Gerar senha</td>
                    <td><code>generatePassword(16)</code></td>
                </tr>
                <tr>
                    <td><code>generateSlug($text)</code></td>
                    <td>Gerar slug</td>
                    <td><code>generateSlug($titulo)</code></td>
                </tr>
                <tr>
                    <td><code>asset($path)</code></td>
                    <td>URL de asset</td>
                    <td><code>asset('css/style.css')</code></td>
                </tr>
            </tbody>
        </table>
    </section>
</div>
