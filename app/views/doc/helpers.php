<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>🛠️ Helpers</h1>
    <p class="doc-intro">
        Funções utilitárias disponíveis em qualquer lugar do projeto, sem necessidade de import.
        Definidas em <code>core/functions.php</code>.
    </p>

    <section class="doc-section">
        <h2>🔒 Segurança</h2>

        <h3>e() — Escape HTML</h3>
        <p>Escapa variáveis para prevenir ataques XSS:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Escape simples</span>
$seguro = e($variavelDoUsuario);

<span class="highlight">// Uso em views</span>
&lt;h1&gt;&lt;?= e($titulo) ?&gt;&lt;/h1&gt;
&lt;p&gt;&lt;?= e($conteudo) ?&gt;&lt;/p&gt;</code></pre>
        </div>

        <h3>eJS() — Escape JavaScript</h3>
        <p>Escapa variáveis para uso seguro em código JavaScript:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Em uma view</span>
&lt;script&gt;
    var titulo = &lt;?= eJS($titulo) ?&gt;;
    var dados = &lt;?= eJS(json_encode($dados)) ?&gt;;
&lt;/script&gt;</code></pre>
        </div>

        <h3>csrf_token() / csrf_verify() / csrf_field()</h3>
        <p>Proteção CSRF para formulários:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Token na sessão (gerado automaticamente)</span>
$token = csrf_token();

<span class="highlight">// Campo hidden no formulário</span>
&lt;form method="POST"&gt;
    &lt;?= csrf_field() ?&gt;
    &lt;button type="submit"&gt;Enviar&lt;/button&gt;
&lt;/form&gt;

<span class="highlight">// Verificação no controller</span>
if (!csrf_verify()) {
    redirect('/contato');
    return;
}</code></pre>
        </div>

        <h3>encrypt() / decrypt()</h3>
        <p>Criptografia AES-256-CBC com HMAC-SHA256 (encrypt-then-MAC):</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Criptografar</span>
$token = encrypt('dado sensivel', 'minha-chave');

<span class="highlight">// Descriptografar (retorna string|false)</span>
$original = decrypt($token, 'minha-chave');</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>💾 Models</h2>

        <h3>model()</h3>
        <p>Carrega o arquivo do model e retorna o namespace para chamada de funções:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Obter namespace do model</span>
$ns = model('usuario');
<span class="highlight">// Retorna: \Blumiga\models\usuario\</span>

<span class="highlight">// Chamar funções do model com interpolação</span>
$usuarios = "{$ns}listar"();
$usuario = "{$ns}buscarPorId"($id);
$criado = "{$ns}criar"($nome, $email);

<span class="highlight">// Como funciona internamente</span>
<span class="highlight">// model('usuario') → '\Blumiga\models\usuario\'</span>
<span class="highlight">// "{$ns}listar"() → '\Blumiga\models\usuario\listar'()</span></code></pre>
        </div>

        <div class="alert alert-info">
            <strong>ℹ️ Padrão BluMiga:</strong> Como o framework é procedural, usamos interpolação de string para chamar funções. <code>"{$ns}funcao"()</code> executa a função retornada pelo namespace.
        </div>
    </section>

    <section class="doc-section">
        <h2>🔄 Redirecionamento</h2>

        <h3>redirect()</h3>
        <p>Redireciona o usuário — valida contra open redirect:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// URL relativa (seguro)</span>
redirect('/usuarios');

<span class="highlight">// Com parâmetros</span>
redirect('/busca', ['q' => 'termo']);

<span class="highlight">// Via rota nomeada</span>
redirect(route('dashboard'));</code></pre>
        </div>

        <h3>redirectJS()</h3>
        <p>Redirecionamento via JavaScript:</p>
        <div class="code-block">
            <pre><code>redirectJS('/pagina');</code></pre>
        </div>

        <h3>windowAlert()</h3>
        <p>Exibe alert JavaScript:</p>
        <div class="code-block">
            <pre><code>windowAlert('Mensagem importante');</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🎲 Geração de Dados</h2>

        <div class="code-block">
            <pre><code><span class="highlight">// Ler valor da sessão</span>
$id = session('usuario_id');

<span class="highlight">// Ler com valor padrão</span>
$nome = session('usuario_nome', 'Visitante');

<span class="highlight">// Ler toda sessão</span>
$todos = session();

<span class="highlight">// Definir valor</span>
sessionSet('usuario_id', 123);

<span class="highlight">// Ler valor definido</span>
$id = sessionGet('usuario_id');

<span class="highlight">// Remover valor</span>
sessionRemove('usuario_id');</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📝 Formulários</h2>

        <h3>inputGET() e inputPOST()</h3>
        <p>Obtém dados de formulários de forma segura via <code>filter_input</code>:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Dados do POST</span>
$nome = inputPOST('nome');
$email = inputPOST('email');

<span class="highlight">// Dados do GET</span>
$pagina = inputGET('page');
$busca = inputGET('q');

<span class="highlight">// Verificar se POST</span>
if (requestPOST()) {
    // Processar formulário
}

<span class="highlight">// Uso em formulário</span>
&lt;form method="POST"&gt;
    &lt;input type="text" name="nome"
           value="&lt;?= e(inputPOST('nome')) ?&gt;"&gt;
&lt;/form&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🎲 Geração de Dados</h2>

        <h3>generatePassword()</h3>
        <p>Gera senhas seguras com <code>random_int</code> (CSPRNG):</p>
        <div class="code-block">
            <pre><code><span class="highlight">// Senha com 16 caracteres</span>
$senha = generatePassword(16);

<span class="highlight">// Sem números</span>
$senha = generatePassword(12, true, false);

<span class="highlight">// Com símbolos</span>
$senha = generatePassword(16, true, true, true);</code></pre>
        </div>

        <h3>generateSlug()</h3>
        <p>Gera slugs amigáveis para URLs:</p>
        <div class="code-block">
            <pre><code>$slug = generateSlug('Olá Mundo! Este é um Post');
<span class="highlight">// Resultado: "ola-mundo-este-e-um-post"</span></code></pre>
        </div>

        <h3>generatePrefix()</h3>
        <p>Gera prefixos aleatórios de 5 caracteres:</p>
        <div class="code-block">
            <pre><code>$prefixo = generatePrefix(); <span class="highlight">// Ex: "abcde"</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📁 Assets</h2>

        <h3>asset()</h3>
        <p>Gera URLs para assets com cache busting:</p>
        <div class="code-block">
            <pre><code><span class="highlight">// URL com versão baseada no timestamp</span>
$cssUrl = asset('assets/css/style.css');
<span class="highlight">// → /assets/css/style.css?v=1693420800</span>

<span class="highlight">// Uso em views</span>
&lt;link rel="stylesheet" href="&lt;?= asset('assets/css/style.css') ?&gt;"&gt;
&lt;script src="&lt;?= asset('assets/js/app.js') ?&gt;"&gt;&lt;/script&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📊 Referência Rápida</h2>
        <table class="doc-table">
            <thead>
                <tr>
                    <th>Função</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <tr><td><code>model($name)</code></td><td>Carrega model e retorna namespace</td></tr>
                <tr><td><code>e($var)</code></td><td>Escape HTML (XSS)</td></tr>
                <tr><td><code>eJS($var)</code></td><td>Escape JavaScript</td></tr>
                <tr><td><code>csrf_token()</code></td><td>Gera token CSRF</td></tr>
                <tr><td><code>csrf_verify()</code></td><td>Valida token CSRF</td></tr>
                <tr><td><code>csrf_field()</code></td><td>Campo hidden CSRF</td></tr>
                <tr><td><code>encrypt($data, $key)</code></td><td>Criptografar AES-256</td></tr>
                <tr><td><code>decrypt($data, $key)</code></td><td>Descriptografar</td></tr>
                <tr><td><code>redirect($url)</code></td><td>Redirecionamento HTTP</td></tr>
                <tr><td><code>session($key)</code></td><td>Ler sessão</td></tr>
                <tr><td><code>sessionSet($key, $val)</code></td><td>Definir sessão</td></tr>
                <tr><td><code>sessionGet($key)</code></td><td>Ler sessão</td></tr>
                <tr><td><code>sessionRemove($key)</code></td><td>Remover da sessão</td></tr>
                <tr><td><code>inputPOST($key)</code></td><td>Dados POST seguros</td></tr>
                <tr><td><code>inputGET($key)</code></td><td>Dados GET seguros</td></tr>
                <tr><td><code>generatePassword($len)</code></td><td>Senha segura aleatória</td></tr>
                <tr><td><code>generateSlug($text)</code></td><td>Slug amigável</td></tr>
                <tr><td><code>asset($path)</code></td><td>URL de asset com versionamento</td></tr>
                <tr><td><code>pre($var)</code></td><td>Debug: exibe variável formatada</td></tr>
            </tbody>
        </table>
    </section>
</div>
