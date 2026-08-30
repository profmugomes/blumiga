<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>📦 Instalação</h1>
    <p class="doc-intro">
        Aprenda como instalar e configurar o BluMiga em seu projeto.
    </p>

    <section class="doc-section">
        <h2>📋 Pré-requisitos</h2>
        <div class="card-grid">
            <div class="card">
                <h3>PHP 8.2+</h3>
                <p>O BluMiga requer PHP 8.2 ou superior para funcionar corretamente.</p>
            </div>
            <div class="card">
                <h3>Composer</h3>
                <p>Gerenciador de dependências PHP necessário para instalação.</p>
            </div>
            <div class="card">
                <h3>Apache/Nginx</h3>
                <p>Servidor web com suporte a PHP e rewrites de URL.</p>
            </div>
        </div>
    </section>

    <section class="doc-section">
        <h2>🚀 Instalação via Composer</h2>
        <p>Execute o seguinte comando para criar um novo projeto:</p>
        <div class="code-block">
            <pre><code>composer create-project bluiceoficial/blumiga meu-projeto</code></pre>
        </div>
        <p>Em seguida, navegue até o diretório do projeto:</p>
        <div class="code-block">
            <pre><code>cd meu-projeto</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📁 Estrutura de Diretórios</h2>
        <div class="code-block">
            <pre><code>meu-projeto/
├── app/
│   ├── controllers/     <span class="highlight"># Controllers</span>
│   ├── middleware/       <span class="highlight"># Middlewares</span>
│   ├── models/          <span class="highlight"># Models</span>
│   └── views/           <span class="highlight"># Views e templates</span>
├── config/
│   ├── config.php       <span class="highlight"># Configurações do app</span>
│   └── routes.php       <span class="highlight"># Definição de rotas</span>
├── core/                <span class="highlight"># Núcleo do framework</span>
├── libs/                <span class="highlight"># Bibliotecas extras</span>
├── public/              <span class="highlight"># Arquivos públicos (CSS, JS, imagens)</span>
├── storage/             <span class="highlight"># Logs, cache, uploads</span>
└── vendor/              <span class="highlight"># Dependências do Composer</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>⚙️ Configuração Inicial</h2>
        <p>Após a instalação, configure o arquivo <code>config/config.php</code>:</p>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// config/config.php</span>

<span class="highlight">// Nome da aplicação</span>
define('APP_NAME', 'Minha Aplicação');

<span class="highlight">// URL base</span>
define('APP_URL', 'http://localhost:8000');

<span class="highlight">// Modo de desenvolvimento</span>
define('APP_DEBUG', true);

<span class="highlight">// Configuração do banco de dados</span>
define('DB_HOST', 'localhost');
define('DB_NAME', 'minha_database');
define('DB_USER', 'root');
define('DB_PASS', '');

<span class="highlight">// Chave de criptografia</span>
define('APP_KEY', 'sua-chave-secreta-aqui');</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🌐 Configuração do .htaccess</h2>
        <p>Para servidores Apache, configure o arquivo <code>public/.htaccess</code>:</p>
        <div class="code-block">
            <pre><code>RewriteEngine On

<span class="highlight"># Redireciona tudo para public/index.php</span>
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>▶️ Iniciar o Servidor</h2>
        <p>Inicie o servidor de desenvolvimento:</p>
        <div class="code-block">
            <pre><code>php blumiga serve</code></pre>
        </div>
        <p>Acesse <code>http://localhost:8000</code> no navegador.</p>
    </section>
</div>
