<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>💾 Models</h1>
    <p class="doc-intro">
        Models no BluMiga são funções PHP organizadas em namespaces que interagem com o banco de dados 
        e contêm a lógica de negócio.
    </p>

    <section class="doc-section">
        <h2>📝 Estrutura Básica</h2>
        <p>Cada model é um arquivo PHP com funções dentro de um namespace:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/models/usuario.php</span>

<span class="highlight">namespace</span> Blumiga\models\usuario;

<span class="highlight">function</span> listar(): array {
    <span class="highlight">// Retornar lista de usuários</span>
    <span class="highlight">return</span> db()->select('usuarios');
}

<span class="highlight">function</span> buscarPorId(int $id): ?array {
    <span class="highlight">return</span> db()->select('usuarios', '*', ['id' => $id]);
}

<span class="highlight">function</span> criar(string $nome, string $email): bool {
    <span class="highlight">return</span> db()->insert('usuarios', [
        'nome' => $nome,
        'email' => $email
    ]);
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🎯 Usando Models</h2>
        <p>A função <code>model()</code> retorna o namespace do model. Use interpolação de string para chamar as funções:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">// Obter namespace do model</span>
$ns = model('usuario');

<span class="highlight">// Chamar funções do model com interpolação</span>
$usuarios = "{$ns}listar"();
$usuario = "{$ns}buscarPorId"(1);

<span class="highlight">// Com parâmetros</span>
$usuario = "{$ns}buscarPorId"($id);
$criado = "{$ns}criar"($nome, $email);

<span class="highlight">// Exemplo completo em um controller</span>
$ns = model('usuario');
$lista = "{$ns}listar"();
$total = "{$ns}contar"();</code></pre>
        </div>

        <div class="alert alert-info">
            <strong>ℹ️ Como funciona:</strong> <code>model('usuario')</code> retorna <code>\Blumiga\models\usuario\</code>. Ao usar <code>"{$ns}listar"()</code>, o PHP interpola a string e executa a função.
        </div>
    </section>

    <section class="doc-section">
        <h2>📁 Organização</h2>
        <p>Estrutura de diretórios para models:</p>
        
        <div class="code-block">
            <pre><code>app/models/
├── usuario.php      <span class="highlight"># namespace Blumiga\models\usuario</span>
├── produto.php      <span class="highlight"># namespace Blumiga\models\produto</span>
├── post.php         <span class="highlight"># namespace Blumiga\models\post</span>
├── categoria.php    <span class="highlight"># namespace Blumiga\models\categoria</span>
└── config.php       <span class="highlight"># namespace Blumiga\models\config</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔧 Exemplo com Banco de Dados</h2>
        <p>Model completo para gerenciamento de usuários:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/models/usuario.php</span>

<span class="highlight">namespace</span> Blumiga\models\usuario;

<span class="highlight">function</span> listar(int $pagina = 1, int $porPagina = 10): array {
    $offset = ($pagina - 1) * $porPagina;
    <span class="highlight">return</span> db()->select('usuarios', '*', null, $porPagina, $offset);
}

<span class="highlight">function</span> buscarPorId(int $id): ?array {
    <span class="highlight">return</span> db()->select('usuarios', '*', ['id' => $id]);
}

<span class="highlight">function</span> buscarPorEmail(string $email): ?array {
    <span class="highlight">return</span> db()->select('usuarios', '*', ['email' => $email]);
}

<span class="highlight">function</span> criar(string $nome, string $email, string $senha): bool {
    <span class="highlight">return</span> db()->insert('usuarios', [
        'nome' => $nome,
        'email' => $email,
        'senha' => password_hash($senha, PASSWORD_DEFAULT)
    ]);
}

<span class="highlight">function</span> atualizar(int $id, array $dados): bool {
    <span class="highlight">return</span> db()->update('usuarios', $dados, ['id' => $id]);
}

<span class="highlight">function</span> deletar(int $id): bool {
    <span class="highlight">return</span> db()->delete('usuarios', ['id' => $id]);
}

<span class="highlight">function</span> contar(): int {
    <span class="highlight">return</span> db()->count('usuarios');
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📋 Usando no Controller</h2>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/controllers/usuario.php</span>

<span class="highlight">namespace</span> Blumiga\controllers\usuario;

<span class="highlight">function</span> index(): <span class="highlight">void</span> {
    $ns = model('usuario');
    $usuarios = "{$ns}listar"();
    view('usuario/lista', compact('usuarios'));
}

<span class="highlight">function</span> show($id): <span class="highlight">void</span> {
    $ns = model('usuario');
    $usuario = "{$ns}buscarPorId"($id);
    
    <span class="highlight">if</span> (!$usuario) {
        sessionSet('error', 'Usuário não encontrado');
        redirect('/usuarios');
        <span class="highlight">return</span>;
    }
    
    view('usuario/detalhe', compact('usuario'));
}

<span class="highlight">function</span> store(): <span class="highlight">void</span> {
    $ns = model('usuario');
    $nome = inputPOST('nome');
    $email = inputPOST('email');
    $senha = inputPOST('senha');
    
    <span class="highlight">if</span> ("{$ns}criar"($nome, $email, $senha)) {
        sessionSet('success', 'Usuário criado com sucesso!');
        redirect('/usuarios');
    } <span class="highlight">else</span> {
        sessionSet('error', 'Erro ao criar usuário');
        redirect('/usuarios/novo');
    }
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>💡 Dicas</h2>
        <ul class="doc-list">
            <li>Mantenha models focados em uma tabela/entidade específica</li>
            <li>Use <code>password_hash()</code> para senhas, nunca armazene em texto puro</li>
            <li>Valide dados antes de inserir no banco</li>
            <li>Use transactions para operações que envolvem múltiplas tabelas</li>
            <li>Sempre use <code>model('nome')</code> para obter o namespace antes de chamar funções</li>
        </ul>
    </section>
</div>
