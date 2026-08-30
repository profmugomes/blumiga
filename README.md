# Blumiga

[![PHPStan](https://github.com/profmugomes/blumiga/actions/workflows/phpstan.yml/badge.svg)](https://github.com/profmugomes/blumiga/actions/workflows/phpstan.yml)
[![Tests](https://github.com/profmugomes/blumiga/actions/workflows/tests.yml/badge.svg)](https://github.com/profmugomes/blumiga/actions/workflows/tests.yml)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D%208.4-777bb4?logo=php&logoColor=white)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-blue?logo=opensourceinitiative&logoColor=white)](LICENSE)

Microframework MVC procedural para PHP, com suporte a MySQL/MariaDB via BlumigaDB.

> Fornecer um núcleo sólido para que cada desenvolvedor monte apenas o framework que realmente precisa.

---

## Requisitos

* PHP 8.4 ou superior
* ext-openssl
* ext-mbstring
* Composer
* Apache, Nginx ou PHP built-in server

### Extensões opcionais

* ext-zlib — compressão gzip
* ext-intl — formatCurrency(), dayOfWeek(), monthName()
* ext-mysqli — banco de dados (BlumigaDB)

---

## Instalação

```bash
composer create-project profmugomes/blumiga meu-projeto
cd meu-projeto
php blumiga serve
```

Acesse `http://localhost:8080`.

---

## Núcleo do Framework

* Rotas com parâmetros, grupos e middlewares
* Controllers com namespaces (procedural)
* Models com proteção Path Traversal
* Views com layouts e escape XSS (`e()`, `eJS()`)
* CSRF Protection (`csrf_token()`, `csrf_verify()`, `csrf_field()`)
* Headers de segurança configuráveis (CSP, HSTS, X-Frame-Options)
* Sessão segura (httponly, secure, samesite, strict mode)
* Criptografia AES-256-CBC + HMAC-SHA256
* Helpers: redirect, session, input, asset, slug, generatePassword
* CLI com 16 comandos
* Autoload via Composer

---

## Estrutura

```text
meu-projeto/
├── app/
│   ├── controllers/
│   ├── middleware/
│   ├── models/
│   └── views/
├── config/
│   ├── config.php
│   └── routes.php
├── core/
├── public/
│   ├── .htaccess
│   └── index.php
├── storage/
├── vendor/
└── composer.json
```

---

## Documentação

Inicie o servidor de desenvolvimento e acesse as páginas de documentação:

| Página | URL |
|--------|-----|
| Início | `/` |
| Instalação | `/doc/instalacao` |
| Rotas | `/doc/rotas` |
| Controllers | `/doc/controllers` |
| Views | `/doc/views` |
| Models | `/doc/models` |
| Middleware | `/doc/middleware` |
| Helpers | `/doc/helpers` |
| CLI | `/doc/cli` |
| Segurança | `/doc/seguranca` |

---

## CLI

```bash
php blumiga serve [porta]          # Servidor de desenvolvimento
php blumiga make:controller nome   # Criar controller
php blumiga make:model nome        # Criar model
php blumiga make:view nome         # Criar view
php blumiga make:middleware nome   # Criar middleware
php blumiga make:migration nome    # Criar migration
php blumiga make:seeder nome       # Criar seeder
php blumiga migrate                # Executar migrations
php blumiga migrate:rollback       # Reverter migrations
php blumiga db:seed [nome]         # Executar seeders
php blumiga route:list             # Listar rotas
php blumiga clear:cache            # Limpar cache
php blumiga version                # Versão
php blumiga key:generate           # Gerar chave de criptografia
```

---

## Patrocínio

Se este projeto te ajuda, considere apoiar:

[![Sponsor](https://img.shields.io/badge/Sponsor-profmugomes-red?logo=github)](https://github.com/sponsors/profmugomes)

[GitHub Sponsors — github.com/sponsors/profmugomes](https://github.com/sponsors/profmugomes)

---

# Autor

**Murilo Gomes Julio**

🌐 https://www.profmugomes.com.br

📺 https://youtube.com/@profmugomes


---

## License

The Blumiga is provided under:

[SPDX-License-Identifier: MIT](https://github.com/profmugomes/blumiga/blob/main/LICENSE)

All contributions to the Blumiga are subject to this license.
