<?php if (!defined('BLUMIGA')) exit; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo ?? 'BluMiga - Documentação') ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <button class="hamburger" aria-label="Menu">☰</button>
    <div class="sidebar-overlay"></div>

    <aside class="sidebar">
        <div class="sidebar-logo">
            <a href="/">
                <div class="logo-icon">⚡</div>
                <div>
                    <div class="logo-text">BluMiga</div>
                    <div class="logo-tag">Microframework MVC</div>
                </div>
            </a>
        </div>
        <nav class="sidebar-nav">
            <div class="sidebar-nav-section">
                <div class="sidebar-nav-section-title">Principal</div>
                <a href="<?= route('home') ?>" class="<?= ($currentPage ?? '') === '/' ? 'active' : '' ?>">
                    <span class="nav-icon">🏠</span> Início
                </a>
            </div>
            <div class="sidebar-nav-section">
                <div class="sidebar-nav-section-title">Guia</div>
                <a href="<?= route('doc.instalacao') ?>" class="<?= ($currentPage ?? '') === '/doc/instalacao' ? 'active' : '' ?>">
                    <span class="nav-icon">📦</span> Instalação
                </a>
                <a href="<?= route('doc.rotas') ?>" class="<?= ($currentPage ?? '') === '/doc/rotas' ? 'active' : '' ?>">
                    <span class="nav-icon">🛤️</span> Rotas
                </a>
                <a href="<?= route('doc.controllers') ?>" class="<?= ($currentPage ?? '') === '/doc/controllers' ? 'active' : '' ?>">
                    <span class="nav-icon">🎮</span> Controllers
                </a>
                <a href="<?= route('doc.views') ?>" class="<?= ($currentPage ?? '') === '/doc/views' ? 'active' : '' ?>">
                    <span class="nav-icon">🎨</span> Views
                </a>
                <a href="<?= route('doc.models') ?>" class="<?= ($currentPage ?? '') === '/doc/models' ? 'active' : '' ?>">
                    <span class="nav-icon">💾</span> Models
                </a>
                <a href="<?= route('doc.middleware') ?>" class="<?= ($currentPage ?? '') === '/doc/middleware' ? 'active' : '' ?>">
                    <span class="nav-icon">🛡️</span> Middleware
                </a>
            </div>
            <div class="sidebar-nav-section">
                <div class="sidebar-nav-section-title">Referência</div>
                <a href="<?= route('doc.helpers') ?>" class="<?= ($currentPage ?? '') === '/doc/helpers' ? 'active' : '' ?>">
                    <span class="nav-icon">🛠️</span> Helpers
                </a>
                <a href="<?= route('doc.cli') ?>" class="<?= ($currentPage ?? '') === '/doc/cli' ? 'active' : '' ?>">
                    <span class="nav-icon">⌨️</span> CLI
                </a>
                <a href="<?= route('doc.seguranca') ?>" class="<?= ($currentPage ?? '') === '/doc/seguranca' ? 'active' : '' ?>">
                    <span class="nav-icon">🔒</span> Segurança
                </a>
            </div>
        </nav>
    </aside>

    <main class="content">
        <?php echo $content ?>

        <footer class="footer">
            <p>&copy; <?= date('Y') ?> BluMiga &mdash; Microframework MVC para PHP</p>
        </footer>
    </main>

    <script src="/assets/js/main.js"></script>
</body>
</html>
