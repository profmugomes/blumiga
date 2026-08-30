<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>🔒 Segurança</h1>
    <p class="doc-intro">
        O BluMiga inclui várias camadas de segurança integradas para proteger sua aplicação
        contra os ataques mais comuns.
    </p>

    <section class="doc-section">
        <h2>🛡️ Headers de Segurança HTTP</h2>
        <p>Configurados automaticamente via <code>config/config.php</code> na variável <code>$headersConfig</code>:</p>

        <div class="code-block">
            <pre><code><span class="highlight">// config/config.php</span>
$headersConfig = [
    'X-Content-Type-Options'       => 'nosniff',
    'X-Frame-Options'              => 'DENY',
    'Referrer-Policy'              => 'strict-origin-when-cross-origin',
    'Permissions-Policy'           => 'camera=(), microphone=(), geolocation=()',
    'Content-Security-Policy'      => "default-src 'self'; ...",
    'Strict-Transport-Security'    => 'max-age=31536000; includeSubDomains',
    'X-XSS-Protection'            => '1; mode=block',
    'Cross-Origin-Opener-Policy'  => 'same-origin',
    'Cross-Origin-Resource-Policy' => 'same-origin',
];</code></pre>
        </div>

        <div class="alert alert-info">
            <strong>ℹ️ Nota:</strong> Apenas headers de uma whitelist são enviados. Valores contendo <code>\r</code> ou <code>\n</code> são rejeitados.
        </div>
    </section>

    <section class="doc-section">
        <h2>🍪 Proteção de Sessão</h2>
        <p>Configuradas em <code>config/config.php</code> na variável <code>$sessionConfig</code>:</p>

        <div class="code-block">
            <pre><code><span class="highlight">// config/config.php</span>
$sessionConfig = [
    'cookie_httponly'           => '1',   <span class="highlight">// Impede acesso via JavaScript</span>
    'cookie_secure'            => '1',   <span class="highlight">// Apenas HTTPS</span>
    'cookie_samesite'          => 'Lax', <span class="highlight">// Proteção CSRF básica</span>
    'use_strict_mode'          => '1',   <span class="highlight">// Rejeita IDs inválidos</span>
    'use_only_cookies'         => '1',   <span class="highlight">// Sem session ID na URL</span>
    'use_trans_sid'            => '0',   <span class="highlight">// Desabilita session ID transparente</span>
    'sid_length'               => '48',  <span class="highlight">// Tamanho do session ID</span>
    'sid_bits_per_character'   => '6',   <span class="highlight">// Complexidade do session ID</span>
];</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔄 CSRF (Cross-Site Request Forgery)</h2>
        <p>Funções integradas para proteção de formulários POST:</p>

        <div class="code-block">
            <pre><code><span class="highlight">&lt;!-- Na view: campo hidden com o token --&gt;</span>
&lt;form method="POST" action="/contato"&gt;
    &lt;?= csrf_field() ?&gt;

    &lt;input type="text" name="nome"&gt;
    &lt;button type="submit"&gt;Enviar&lt;/button&gt;
&lt;/form&gt;

<span class="highlight">// No controller: verificar antes de processar</span>
function enviar(): void {
    <span class="highlight">if</span> (!csrf_verify()) {
        redirect('/contato');
        <span class="highlight">return</span>;
    }

    <span class="highlight">// Processar formulário seguro...</span>
}

<span class="highlight">// Obter o token para uso manual</span>
$token = csrf_token();</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🚫 XSS Prevention</h2>
        <p>Escape de todas as variáveis usando <code>e()</code> e <code>eJS()</code>:</p>

        <div class="code-block">
            <pre><code><span class="highlight">// INCORRETO - vulnerável a XSS</span>
&lt;h1&gt;&lt;?= $titulo ?&gt;&lt;/h1&gt;

<span class="highlight">// CORRETO - com escape HTML</span>
&lt;h1&gt;&lt;?= e($titulo) ?&gt;&lt;/h1&gt;
&lt;input value="&lt;?= e($valor) ?&gt;"&gt;

<span class="highlight">// CORRETO - escape para JavaScript</span>
&lt;script&gt;
    var titulo = &lt;?= eJS($titulo) ?&gt;;
&lt;/script&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📁 Path Traversal Prevention</h2>
        <p>Proteção automática em <code>view()</code>, <code>model()</code>, <code>deleteDir()</code> e funções de arquivo:</p>

        <div class="code-block">
            <pre><code><span class="highlight">// Todas estas funções validam com realpath() + str_starts_with()</span>
view('home/index');           <span class="highlight">// Protegido</span>
model('usuario');             <span class="highlight">// Protegido</span>
deleteDir('/pasta');          <span class="highlight">// Protegido</span>
readFileContent('arquivo');   <span class="highlight">// Protegido</span>
writeFileContent('arquivo');  <span class="highlight">// Protegido</span>
deleteFile('arquivo');        <span class="highlight">// Protegido</span>

<span class="highlight">// Routes que contêm ../ são rejeitadas automaticamente</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔐 Criptografia AES-256-CBC</h2>
        <p>Encrypt-then-MAC com verificação timing-safe:</p>

        <div class="code-block">
            <pre><code><span class="highlight">// Criptografar dados</span>
$criptografado = encrypt('dado sensivel', 'minha-chave');

<span class="highlight">// Descriptografar (retorna string|false)</span>
$original = decrypt($criptografado, 'minha-chave');

<span class="highlight">// Não use a mesma chave para propósitos diferentes</span></code></pre>
        </div>

        <div class="alert alert-info">
            <strong>ℹ️ Importante:</strong> Use <code>php blumiga key:generate</code> para gerar chaves seguras. Nunca armazene chaves no código-fonte.
        </div>
    </section>

    <section class="doc-section">
        <h2>🔄 Open Redirect Prevention</h2>
        <p>A função <code>redirect()</code> valida a URL de destino:</p>

        <div class="code-block">
            <pre><code><span class="highlight">// Seguro — URL relativa</span>
redirect('/dashboard');

<span class="highlight">// Seguro — mesmo domínio</span>
redirect('https://meusite.com/pagina');

<span class="highlight">// Bloqueado — domínio diferente</span>
redirect('https://site-malicioso.com');
<span class="highlight">// → Redirecionado para '/' automaticamente</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🌐 IP do Visitante</h2>
        <p>A função <code>getClientIP()</code> suporta Cloudflare e proxy reverso:</p>

        <div class="code-block">
            <pre><code><span class="highlight">// Cloudflare — detectado automaticamente</span>
$ip = getClientIP();

<span class="highlight">// Para proxy reverso, defina a constante:</span>
define('BLUMIGA_TRUSTED_PROXY', true);

<span class="highlight">// X-Forwarded-For será considerado apenas quando definido</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>✅ Checklist de Segurança</h2>
        <div class="cards-grid">
            <div class="card">
                <h3>Formulários</h3>
                <ul>
                    <li>Use <code>csrf_field()</code> em todos os POST</li>
                    <li>Valide com <code>csrf_verify()</code> no controller</li>
                    <li>Escape com <code>e()</code></li>
                </ul>
            </div>
            <div class="card">
                <h3>Banco de Dados</h3>
                <ul>
                    <li>Use prepared statements</li>
                    <li>Nunca mostre erros SQL</li>
                    <li>Restrinja permissões do usuário DB</li>
                </ul>
            </div>
            <div class="card">
                <h3>Sessões</h3>
                <ul>
                    <li>Regenere ID após login</li>
                    <li>Use cookies seguros (configurado)</li>
                    <li>Implemente timeout</li>
                </ul>
            </div>
            <div class="card">
                <h3>Arquivos</h3>
                <ul>
                    <li>Use <code>readFileContent()</code> (protegido)</li>
                    <li>Valide extensões</li>
                    <li>Restrinja diretório</li>
                </ul>
            </div>
        </div>
    </section>
</div>
