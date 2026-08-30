<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>⌨️ CLI</h1>
    <p class="doc-intro">
        Interface de linha de comando para gerar código, gerenciar banco de dados e outras tarefas.
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
                    <td><code>php blumiga serve [porta]</code></td>
                    <td>Inicia o servidor de desenvolvimento (padrão: 8080)</td>
                </tr>
                <tr>
                    <td><code>php blumiga make:controller nome</code></td>
                    <td>Cria um novo controller em <code>app/controllers/</code></td>
                </tr>
                <tr>
                    <td><code>php blumiga make:model nome</code></td>
                    <td>Cria um novo model em <code>app/models/</code></td>
                </tr>
                <tr>
                    <td><code>php blumiga make:view nome</code></td>
                    <td>Cria uma nova view em <code>app/views/</code></td>
                </tr>
                <tr>
                    <td><code>php blumiga make:middleware nome</code></td>
                    <td>Cria um novo middleware em <code>app/middleware/</code></td>
                </tr>
                <tr>
                    <td><code>php blumiga make:migration nome</code></td>
                    <td>Cria uma migration em <code>app/database/migrations/</code></td>
                </tr>
                <tr>
                    <td><code>php blumiga make:seeder nome</code></td>
                    <td>Cria um seeder em <code>app/database/seeders/</code></td>
                </tr>
                <tr>
                    <td><code>php blumiga migrate</code></td>
                    <td>Executa as funções <code>up</code> de todas as migrations</td>
                </tr>
                <tr>
                    <td><code>php blumiga migrate:rollback</code></td>
                    <td>Executa as funções <code>down</code> das migrations (ordem reversa)</td>
                </tr>
                <tr>
                    <td><code>php blumiga db:seed [nome]</code></td>
                    <td>Alimenta o banco executando as funções <code>run</code></td>
                </tr>
                <tr>
                    <td><code>php blumiga db:seed:rollback [nome]</code></td>
                    <td>Limpa dados executando as funções <code>down</code> dos seeders</td>
                </tr>
                <tr>
                    <td><code>php blumiga route:list</code></td>
                    <td>Lista todas as rotas registradas</td>
                </tr>
                <tr>
                    <td><code>php blumiga clear:cache</code></td>
                    <td>Limpa OPcache e arquivos do <code>storage/cache/</code></td>
                </tr>
                <tr>
                    <td><code>php blumiga version</code></td>
                    <td>Exibe a versão do Blumiga</td>
                </tr>
                <tr>
                    <td><code>php blumiga key:generate [tamanho]</code></td>
                    <td>Gera uma chave de criptografia segura</td>
                </tr>
                <tr>
                    <td><code>php blumiga help</code></td>
                    <td>Exibe o menu de ajuda</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="doc-section">
        <h2>▶️ Servidor de Desenvolvimento</h2>
        <div class="code-block">
            <pre><code><span class="highlight"># Porta padrão (8080)</span>
php blumiga serve

<span class="highlight"># Porta específica (validação: 1-65535)</span>
php blumiga serve 3000</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔧 Gerando Código</h2>

        <div class="code-block">
            <pre><code><span class="highlight"># Controller — app/controllers/usuario.php</span>
php blumiga make:controller usuario

<span class="highlight"># Controller com subpasta — app/controllers/admin/dashboard.php</span>
php blumiga make:controller admin/dashboard

<span class="highlight"># Model — app/models/usuarioModel.php</span>
php blumiga make:model usuario

<span class="highlight"># View — app/views/usuario/lista.php</span>
php blumiga make:view usuario/lista

<span class="highlight"># Middleware — app/middleware/auth.php</span>
php blumiga make:middleware auth

<span class="highlight"># Migration — app/database/migrations/2026_08_30_criar_usuarios.php</span>
php blumiga make:migration criar_usuarios

<span class="highlight"># Seeder — app/database/seeders/usuariosSeeder.php</span>
php blumiga make:seeder usuarios</code></pre>
        </div>

        <div class="alert alert-info">
            <strong>ℹ️ Segurança:</strong> Nomes são sanitizados automaticamente — apenas letras, números, underscores e barras são aceitos.
        </div>
    </section>

    <section class="doc-section">
        <h2>💾 Banco de Dados</h2>

        <div class="code-block">
            <pre><code><span class="highlight"># Executar todas as migrations</span>
php blumiga migrate

<span class="highlight"># Reverter todas as migrations (ordem reversa)</span>
php blumiga migrate:rollback

<span class="highlight"># Popular banco com todos os seeders</span>
php blumiga db:seed

<span class="highlight"># Popular seeder específico</span>
php blumiga db:seed usuarios

<span class="highlight"># Reverter seeder específico</span>
php blumiga db:seed:rollback usuarios</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>💡 Dicas</h2>
        <ul class="doc-list">
            <li>Use <code>make:*</code> para gerar código boilerplate rapidamente</li>
            <li>Execute <code>migrate</code> antes de <code>db:seed</code> para garantir que as tabelas existam</li>
            <li>Use <code>route:list</code> para verificar se suas rotas estão corretas</li>
            <li>Use <code>clear:cache</code> após mudanças em configurações</li>
            <li>Em produção, desative o servidor de desenvolvimento</li>
        </ul>
    </section>
</div>
