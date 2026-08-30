<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>🔒 Segurança</h1>
    <p class="doc-intro">
        O BluMiga inclui várias funcionalidades de segurança integradas para proteger sua aplicação 
        contra ataques comuns.
    </p>

    <section class="doc-section">
        <h2>🛡️ Headers de Segurança HTTP</h2>
        <p>O framework configura automaticamente headers de segurança importantes:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// Headers configurados automaticamente:</span>
X-Content-Type-Options: nosniff
X-Frame-Options: SAMEORIGIN
X-XSS-Protection: 1; mode=block
Referrer-Policy: strict-origin-when-cross-origin
Content-Security-Policy: default-src 'self'</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🍪 Proteção de Sessão</h2>
        <p>Sessões configuradas com segurança:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// Configurações de sessão seguras:</span>
session.cookie_httponly = 1    <span class="highlight">// Impede acesso via JavaScript</span>
session.cookie_secure = 1      <span class="highlight">// Apenas HTTPS</span>
session.cookie_samesite = Lax  <span class="highlight">// Proteção CSRF básica</span>
session.use_strict_mode = 1    <span class="highlight">// Rejeita IDs inválidos</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔄 CSRF (Cross-Site Request Forgery)</h2>
        <p>Proteção contra ataques CSRF em formulários:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">&lt;!-- Em formulários HTML --&gt;</span>
&lt;form method="POST" action="/contato"&gt;
    &lt;input type="hidden" name="csrf_token" 
           value="&lt;?= e(csrf_token()) ?&gt;"&gt;
    
    &lt;input type="text" name="nome"&gt;
    &lt;button type="submit"&gt;Enviar&lt;/button&gt;
&lt;/form&gt;

<span class="highlight">&lt;!-- Validação no controller --&gt;</span>
function enviar(): void {
    <span class="highlight">if</span> (!csrf_verify(inputPOST('csrf_token'))) {
        session('error', 'Token CSRF inválido');
        redirect('/contato');
        <span class="highlight">return</span>;
    }
    
    <span class="highlight">// Processar formulário...</span>
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🚫 XSS Prevention</h2>
        <p>Escape de todas as variáveis usando a função <code>e()</code>:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// INCORRETO - vulnerável a XSS</span>
&lt;h1&gt;&lt;?= $titulo ?&gt;&lt;/h1&gt;
&lt;p&gt;&lt;?= $conteudo ?&gt;&lt;/p&gt;

<span class="highlight">// CORRETO - com escape</span>
&lt;h1&gt;&lt;?= e($titulo) ?&gt;&lt;/h1&gt;
&lt;p&gt;&lt;?= e($conteudo) ?&gt;&lt;/p&gt;

<span class="highlight">// Em atributos HTML</span>
&lt;input type="text" value="&lt;?= e($valor) ?&gt;"&gt;
&lt;a href="&lt;?= e($url) ?&gt;"&gt;Link&lt;/a&gt;

<span class="highlight">// Em JavaScript</span>
&lt;script&gt;
    var titulo = '&lt;?= eJS($titulo) ?&gt;';
&lt;/script&gt;</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📁 Path Traversal Prevention</h2>
        <p>Proteção contra acesso indevido a arquivos:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// Validação de caminhos</span>
function safePath(string $path): string {
    <span class="highlight">// Remove ../ e caracteres perigosos</span>
    $path = str_replace(['../', '..\\', ''], '', $path);
    
    <span class="highlight">// Remove barras duplas</span>
    $path = preg_replace('#/+#', '/', $path);
    
    <span class="highlight">// Define diretório base</span>
    $basePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    
    <span class="highlight">// Verifica se o caminho está dentro do base</span>
    $fullPath = realpath($basePath . $path);
    
    <span class="highlight">if</span> (strpos($fullPath, realpath($basePath)) !== 0) {
        <span class="highlight">throw new</span> \Exception('Acesso negado');
    }
    
    <span class="highlight">return</span> $fullPath;
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔐 Criptografia AES-256-CBC</h2>
        <p>Funções para criptografar e descriptografar dados sensíveis:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// Configuração</span>
define('APP_KEY', 'chave-secreta-32-characters-long!');

<span class="highlight">// Criptografar dados</span>
function encrypt(string $data): string {
    $key = APP_KEY;
    $iv = openssl_random_pseudo_bytes(16);
    
    $encrypted = openssl_encrypt(
        $data,
        'aes-256-cbc',
        $key,
        0,
        $iv
    );
    
    <span class="highlight">return</span> base64_encode($iv . ':' . $encrypted);
}

<span class="highlight">// Descriptografar dados</span>
function decrypt(string $data): string {
    $key = APP_KEY;
    $decoded = base64_decode($data);
    list($iv, $encrypted) = explode(':', $decoded, 2);
    
    <span class="highlight">return</span> openssl_decrypt(
        $encrypted,
        'aes-256-cbc',
        $key,
        0,
        $iv
    );
}</code></pre>
        </div>

        <div class="alert alert-info">
            <strong>ℹ️ Importante:</strong> Nunca armazene APP_KEY no código-fonte. Use variáveis de ambiente ou arquivo de configuração fora do diretório público.
        </div>
    </section>

    <section class="doc-section">
        <h2>✅ Boas Práticas</h2>
        <ul class="doc-list">
            <li><strong>Sempre use <code>e()</code></strong> para exibir dados do usuário ou banco de dados</li>
            <li><strong>Valide entradas</strong> - Nunca confie em dados vindos do cliente</li>
            <li><strong>Use HTTPS</strong> - Configure SSL/TLS em produção</li>
            <li><strong>Senhas seguras</strong> - Use <code>password_hash()</code> e <code>password_verify()</code></li>
            <li><strong>Permissões de arquivo</strong> - Restringa acesso a diretórios sensíveis</li>
            <li><strong>Atualize dependências</strong> - Mantenha Composer e pacotes atualizados</li>
            <li><strong>Logs de segurança</strong> - Registre tentativas de acesso suspeitas</li>
        </ul>
    </section>

    <section class="doc-section">
        <h2>⚠️ Checklist de Segurança</h2>
        <div class="card-grid">
            <div class="card">
                <h3>✅ Formulários</h3>
                <ul>
                    <li>Use CSRF token</li>
                    <li>Valide todos os campos</li>
                    <li>Escape com <code>e()</code></li>
                </ul>
            </div>
            <div class="card">
                <h3>✅ Banco de Dados</h3>
                <ul>
                    <li>Use prepared statements</li>
                    <li>Nunca mostre erros SQL</li>
                    <li>Restrinja permissões do usuário DB</li>
                </ul>
            </div>
            <div class="card">
                <h3>✅ Sessões</h3>
                <ul>
                    <li>Regenere ID após login</li>
                    <li>Use cookies seguros</li>
                    <li>Implemente timeout</li>
                </ul>
            </div>
            <div class="card">
                <h3>✅ Arquivos</h3>
                <ul>
                    <li>Valide extensões</li>
                    <li>Use MIME type</li>
                    <li>Restrinja diretório</li>
                </ul>
            </div>
        </div>
    </section>
</div>
