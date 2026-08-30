<?php if (!defined('BLUMIGA')) exit; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página não encontrada | BluMiga</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="error-page">
        <div class="error-container">
            <div class="error-icon">🔍</div>
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Página não encontrada</h2>
            <p class="error-message">
                Ops! A página que você procura não existe ou foi movida para outro endereço.
            </p>
            <div class="error-actions">
                <a href="/" class="btn btn-primary">🏠 Voltar ao Início</a>
                <a href="javascript:history.back()" class="btn btn-secondary">← Voltar</a>
            </div>
            <div class="error-help">
                <p>Precisa de ajuda? Consulte a <a href="/doc">documentação</a>.</p>
            </div>
        </div>
    </div>
</body>
</html>
