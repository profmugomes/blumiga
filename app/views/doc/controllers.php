<?php if (!defined('BLUMIGA')) exit; ?>
<div class="doc-content">
    <h1>🎮 Controllers</h1>
    <p class="doc-intro">
        Controllers no BluMiga são funções PHP organizadas em namespaces. Eles processam as requisições 
        e retornam respostas.
    </p>

    <section class="doc-section">
        <h2>📝 Estrutura Básica</h2>
        <p>Cada controller é um arquivo PHP com funções dentro de um namespace:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/controllers/home.php</span>

<span class="highlight">namespace</span> Blumiga\controllers\home;

<span class="highlight">function</span> index(): <span class="highlight">void</span> {
    $titulo = 'Página Inicial';
    view('home/index', compact('titulo'));
}

<span class="highlight">function</span> sobre(): <span class="highlight">void</span> {
    $conteudo = 'Sobre nós...';
    view('sobre/index', compact('conteudo'));
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🎯 Formato Controller@metodo</h2>
        <p>As rotas referenciam controllers no formato <code>Controller@metodo</code>:</p>
        
        <table class="doc-table">
            <thead>
                <tr>
                    <th>Rota</th>
                    <th>Controller</th>
                    <th>Arquivo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>home@index</code></td>
                    <td>Função <code>index()</code></td>
                    <td><code>app/controllers/home.php</code></td>
                </tr>
                <tr>
                    <td><code>usuario@show</code></td>
                    <td>Função <code>show()</code></td>
                    <td><code>app/controllers/usuario.php</code></td>
                </tr>
                <tr>
                    <td><code>auth@logar</code></td>
                    <td>Função <code>logar()</code></td>
                    <td><code>app/controllers/auth.php</code></td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="doc-section">
        <h2>📁 Organização</h2>
        <p>Estrutura de diretórios para controllers:</p>
        
        <div class="code-block">
            <pre><code>app/controllers/
├── home.php          <span class="highlight"># namespace Blumiga\controllers\home</span>
├── auth.php          <span class="highlight"># namespace Blumiga\controllers\auth</span>
├── usuario.php       <span class="highlight"># namespace Blumiga\controllers\usuario</span>
├── admin/
│   ├── dashboard.php <span class="highlight"># namespace Blumiga\controllers\admin\dashboard</span>
│   └── config.php    <span class="highlight"># namespace Blumiga\controllers\admin\config</span>
└── api/
    └── users.php     <span class="highlight"># namespace Blumiga\controllers\api\users</span></code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>🔧 Recebendo Parâmetros</h2>
        <p>Parâmetros de rota são passados como argumentos para as funções:</p>
        
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// Rota: routeGET('/usuario/{id}', 'usuario@show')</span>

<span class="highlight">namespace</span> Blumiga\controllers\usuario;

<span class="highlight">function</span> show($id): <span class="highlight">void</span> {
    <span class="highlight">// Buscar usuário pelo ID</span>
    $usuario = model('usuario')->buscarPorId($id);
    
    view('usuario/show', compact('usuario'));
}

<span class="highlight">function</span> update($id): <span class="highlight">void</span> {
    <span class="highlight">// Receber dados do POST</span>
    $nome = inputPOST('nome');
    $email = inputPOST('email');
    
    model('usuario')->atualizar($id, $nome, $email);
    redirect('/usuario/' . $id);
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>📋 Exemplo Completo</h2>
        <div class="code-block">
            <pre><code><span class="highlight">&lt;?php</span>
<span class="highlight">// app/controllers/contato.php</span>

<span class="highlight">namespace</span> Blumiga\controllers\contato;

<span class="highlight">function</span> index(): <span class="highlight">void</span> {
    $pageTitle = 'Contato';
    view('contato/index', compact('pageTitle'));
}

<span class="highlight">function</span> enviar(): <span class="highlight">void</span> {
    $nome = inputPOST('nome');
    $email = inputPOST('email');
    $mensagem = inputPOST('mensagem');
    
    <span class="highlight">// Validar dados</span>
    <span class="highlight">if</span> (empty($nome) || empty($email) || empty($mensagem)) {
        session('error', 'Preencha todos os campos');
        redirect('/contato');
        <span class="highlight">return</span>;
    }
    
    <span class="highlight">// Enviar email (exemplo)</span>
    mail('admin@example.com', 'Contato: ' . $nome, $mensagem);
    
    session('success', 'Mensagem enviada com sucesso!');
    redirect('/contato');
}</code></pre>
        </div>
    </section>

    <section class="doc-section">
        <h2>💡 Dicas</h2>
        <ul class="doc-list">
            <li>Mantenha controllers pequenos e focados em uma responsabilidade</li>
            <li>Use <code>extract()</code> para passar variáveis para views: <code>view('path', compact('var1', 'var2'))</code></li>
            <li>Valide dados de entrada sempre que possível</li>
            <li>Redirecione após operações POST para evitar reenvio de formulários</li>
        </ul>
    </section>
</div>
