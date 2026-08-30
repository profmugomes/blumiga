<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>⌨️ CLI</h1>
    <p class="doc-intro">
        O BluMiga oferece uma interface de linha de comando (CLI) para gerar código, 
        gerenciar banco de dados e outras tarefas de desenvolvimento.
    </p>

    <section class="doc-section">
        <h2>🚀 Comandos Disponíveis</h2>
        
        <table class="doc-table">
            <thead>
                <tr>
                    <th>Comando</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>php blumiga serve</code></td>
                    <td>Inicia o servidor de desenvolvimento local</td>
                </tr>
                <tr>
                    <td><code>php blumiga make:controller</code></td>
                    <td>Cria um novo controller</td>
                </tr>
                <tr>
                    <td><code>php blumiga make:model</code></td>
                    <td>Cria um novo model</td>
                </tr>
                <tr>
                    <td><code>php blumiga make:middleware</code></td>
                    <td>Cria um novo middleware</td>
                </tr>
                <tr>
                    <td><code>php blumiga make:view</code></td>
                    <td>Cria uma nova view</td>
                </tr>
                <tr>
                    <td><code>php blumiga make:migration</code></td>
                    <td>Cria uma nova migration</td>
                </tr>
                <tr>
                    <td><code>php blumiga migrate</code></td>
                    <td>Executa as migrations pendentes</td>
                </tr>
                <tr>
                    <td><code>php blumiga migrate:rollback</code></td>
                    <td>Reverte a última migration</td>
                </tr>
                <tr>
                    <td><code>php blumiga db:seed</code></td>
                    <td>Popula o banco com dados de teste</td>
                </tr>
                <tr>
                    <td><code>php blumiga db:reset</code></td>
                    <td>Reset e recria o banco de dados</td>
                </tr>
                <tr>
                    <td><code>php blumiga version</code></td>
                    <td>Exibe a versão do BluMiga</td>
                </tr>
                <tr>
                    <td><code>php blumiga route:list</code></td>
                    <td>Lista todas as rotas registradas</td>
                </tr>
                <tr>
                    <td><code>php blumiga clear:cache</code></td>
                    <td>Limpa o cache da aplicação</td>
                </tr>
                <tr>
                    <td><code>php blumiga clear:logs</code></td>
                    <td>Limpa os arquivos de log</td>
                </tr>
                <tr>
                    <td><code>php blumiga key:generate</code></td>
                    <td>Gera uma nova chave de criptografia</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="doc-section">
        <h2>▶️ Servidor de Desenvolvimento</h2>
        <p>Inicie o servidor local para desenvolvimento:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight"># Iniciar na porta padrão (8000)</span>
php blumiga serve

<span class="highlight"># Iniciar em porta específica</span>
php blumiga serve --port=3000

<span class="highlight"># Iniciar acessível na rede</span>
php blumiga serve --host=0.0.0.0</code></pre>
        </div>
        
        <p>Acesse <code>http://localhost:8000</code> no navegador.</p>
    </section>

    <section class="doc-section">
        <h2>🔧 Gerando Código</h2>
        
        <h3>Controller</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Criar controller</span>
php blumiga make:controller usuario

<span class="highlight"># Resultado: app/controllers/usuario.php</span></code></pre>
        </div>

        <h3>Model</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Criar model</span>
php blumiga make:model usuario

<span class="highlight"># Resultado: app/models/usuario.php</span></code></pre>
        </div>

        <h3>Middleware</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Criar middleware</span>
php blumiga make:middleware auth

<span class="highlight"># Resultado: app/middleware/auth.php</span></code></pre>
        </div>

        <h3>View</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Criar view</span>
php blumiga make:view usuario/lista

<span class="highlight"># Resultado: app/views/usuario/lista.php</span></code></pre>
        </div>

        <h3>Migration</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Criar migration</span>
php blumiga make:migration criar_tabela_usuarios

<span class="highlight"># Resultado: database/migrations/2024_01_01_criar_tabela_usuarios.php</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>💾 Banco de Dados</h2>
        
        <h3>Migrations</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Executar migrations pendentes</span>
php blumiga migrate

<span class="highlight"># Reverter última migration</span>
php blumiga migrate:rollback

<span class="highlight"># Reverter todas as migrations</span>
php blumiga migrate:reset</code></pre>
        </div>

        <h3>Seeding</h3>
        <div class="code-block">
            <pre><code><span class="highlight"># Popular banco com dados de teste</span>
php blumiga db:seed

<span class="highlight"># Resetar e recriar banco</span>
php blumiga db:reset</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔧 Outros Comandos Úteis</h2>
        
        <div class="code-block">
            <pre><code><span class="highlight"># Ver versão do BluMiga</span>
php blumiga version

<span class="highlight"># Listar todas as rotas</span>
php blumiga route:list

<span class="highlight"># Limpar cache</span>
php blumiga clear:cache

<span class="highlight"># Limpar logs</span>
php blumiga clear:logs

<span class="highlight"># Gerar nova chave de criptografia</span>
php blumiga key:generate</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>💡 Dicas</h2>
        <ul class="doc-list">
            <li>Use <code>make:*</code> para gerar código boilerplate rapidamente</li>
            <li>Execute <code>migrate</code> antes de <code>db:seed</code> para garantir que as tabelas existam</li>
            <li>Use <code>route:list</code> para verificar se suas rotas estão corretas</li>
            <li>Em produção, desative o servidor de desenvolvimento</li>
        </ul>
    </section>
</div>
