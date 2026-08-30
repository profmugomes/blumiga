# SKILLs.md — BluMiga Framework

Referência completa de todas as skills disponíveis no BluMiga.

---

## 1. Scaffolding (Geração de Código)

### make:controller
- **Descrição:** Cria um novo controller funcional
- **Comando:** `php blumiga make:controller nome`
- **Exemplo:** `php blumiga make:controller admin/contato`
- **Resultado:** Cria `app/controllers/admin/contato.php` com namespace `Blumiga\controllers\admin\contato`
- **Template:**
```php
<?php
namespace Blumiga\controllers\admin\contato;

function index(): void {
    echo "Bem-vindo ao Controller Funcional contato!";
}
```

### make:model
- **Descrição:** Cria um novo model funcional
- **Comando:** `php blumiga make:model nome`
- **Exemplo:** `php blumiga make:model usuario`
- **Resultado:** Cria `app/models/usuarioModel.php` com namespace `Blumiga\models\usuarioModel`
- **Template:**
```php
<?php
namespace Blumiga\models\usuarioModel;

if (!defined('BLUMIGA')) exit;

function getData(): array {
    return [];
}

function getById(int $id): array {
    return [];
}
```

### make:view
- **Descrição:** Cria uma nova view
- **Comando:** `php blumiga make:view nome`
- **Exemplo:** `php blumiga make:view contato/index`
- **Resultado:** Cria `app/views/contato/index.php`
- **Template:**
```php
<?php
if (!defined('BLUMIGA')) exit;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Blumiga View</title>
</head>
<body>
    <h1>Estilização Funcional Blumiga</h1>
    <p>Sua view está pronta para renderizar os dados do escopo.</p>
</body>
</html>
```

### make:middleware
- **Descrição:** Cria um novo middleware
- **Comando:** `php blumiga make:middleware nome`
- **Exemplo:** `php blumiga make:middleware auth`
- **Resultado:** Cria `app/middleware/auth.php` com namespace `Blumiga\middleware\auth`
- **Template:**
```php
<?php
namespace Blumiga\middleware\auth;

if (!defined('BLUMIGA')) exit;

function run(callable $next, mixed $param = null): void {
    $next();
}
```
- **Uso em rotas:** `routeGET('/rota', 'ctrl@func', 'nome', ['auth@run']);`

### make:migration
- **Descrição:** Cria uma nova migration
- **Comando:** `php blumiga make:migration nome`
- **Exemplo:** `php blumiga make:migration criar_usuarios`
- **Resultado:** Cria `app/database/migrations/2026_08_30_120000_criar_usuarios.php`
- **Template:**
```php
<?php
return [
    'up' => function() {
        // Schema here
    },
    'down' => function() {
        // Rollback here
    }
];
```

### make:seeder
- **Descrição:** Cria um novo seeder
- **Comando:** `php blumiga make:seeder nome`
- **Exemplo:** `php blumiga make:seeder usuarios_padrao`
- **Resultado:** Cria `app/database/seeders/usuarios_padraoSeeder.php`
- **Template:**
```php
<?php
return [
    'run' => function() {
        // Seed data here
    },
    'down' => function() {
        // Rollback here
    }
];
```

---

## 2. Database (Migrations & Seeders)

### migrate
- **Descrição:** Executa todas as migrations (função `up`)
- **Comando:** `php blumiga migrate`
- **Resultado:** Executa migrations em ordem alfabética

### migrate:rollback
- **Descrição:** Reverte todas as migrations (função `down`, ordem reversa)
- **Comando:** `php blumiga migrate:rollback`
- **Resultado:** Executa rollback em ordem reversa

### db:seed
- **Descrição:** Executa seeders
- **Comando:** `php blumiga db:seed [nome]`
- **Exemplo:** `php blumiga db:seed usuarios_padrao`
- **Resultado:** Executa seeder específico ou todos

### db:seed:rollback
- **Descrição:** Reverte seeders (função `down`)
- **Comando:** `php blumiga db:seed:rollback [nome]`
- **Exemplo:** `php blumiga db:seed:rollback usuarios_padrao`

---

## 3. Desenvolvimento

### serve
- **Descrição:** Inicia servidor de desenvolvimento
- **Comando:** `php blumiga serve [porta]`
- **Porta padrão:** 8080
- **Validação:** Porta deve ser 1-65535

### route:list
- **Descrição:** Lista todas as rotas registradas
- **Comando:** `php blumiga route:list`
- **Resultado:** Lista formatada com método, rota e nome

### clear:cache
- **Descrição:** Limpa OPcache + storage/cache
- **Comando:** `php blumiga clear:cache`
- **Resultado:** Remove arquivos do storage/cache e reseta OPcache

### version
- **Descrição:** Exibe a versão do BluMiga
- **Comando:** `php blumiga version`
- **Resultado:** Exibe versão do composer.json

### key:generate
- **Descrição:** Gera chave de criptografia
- **Comando:** `php blumiga key:generate [tamanho]`
- **Tamanho:** 16-128 bytes (padrão: 32)
- **Resultado:** Chave base64 para usar em config.php

---

## 4. Testing

### composer test
- **Descrição:** Executa todos os testes PHPUnit
- **Comando:** `composer test`
- **Resultado:** 99 testes, 123 assertions

### composer test:security
- **Descrição:** Executa testes de segurança
- **Comando:** `composer test:security`
- **Resultado:** 48 testes (XSS, CSRF, Path Traversal, Open Redirect, Encrypt, IP)

### composer test:error
- **Descrição:** Executa testes de tratamento de erros
- **Comando:** `composer test:error`
- **Resultado:** 7 testes (route, dispatchRoute, asset)

### composer test:unit
- **Descrição:** Executa testes unitários
- **Comando:** `composer test:unit`
- **Resultado:** 46 testes (strings, passwords, session, dates, input)

### composer analyse
- **Descrição:** Executa PHPStan nível 5
- **Comando:** `composer analyse`
- **Resultado:** 0 erros

---

## 5. Helpers — Segurança

### e($value)
- **Descrição:** Escape HTML (previne XSS)
- **Parâmetros:** `string $value`
- **Retorno:** `string`
- **Exemplo:** `<?= e($usuario['nome']) ?>`
- **Implementação:** `htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')`

### eJS($value)
- **Descrição:** Escape JavaScript (usa json_encode)
- **Parâmetros:** `string $value`
- **Retorno:** `string`
- **Exemplo:** `<script>var nome = <?= eJS($nome) ?>;</script>`
- **Implementação:** `json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)`

### encrypt($value, $key)
- **Descrição:** Criptografa valor (AES-256-CBC + HMAC-SHA256)
- **Parâmetros:** `string $value, string $key`
- **Retorno:** `string` (base64)
- **Algoritmo:** encrypt-then-MAC
- **Chaves:** Derivadas via hash_hmac

### decrypt($value, $key)
- **Descrição:** Descriptografa valor
- **Parâmetros:** `string $value, string $key`
- **Retorno:** `string|false`
- **Verificação:** HMAC timing-safe com hash_equals()

### csrf_token()
- **Descrição:** Gera token CSRF na sessão
- **Retorno:** `string` (64 chars hex)
- **Implementação:** `bin2hex(random_bytes(32))`

### csrf_verify(?string $token)
- **Descrição:** Valida token CSRF
- **Parâmetros:** `?string $token` (opcional, usa inputPOST se null)
- **Retorno:** `bool`
- **Implementação:** `hash_equals()` (timing-safe)

### csrf_field()
- **Descrição:** Campo hidden HTML para CSRF
- **Retorno:** `string` (HTML input)
- **Exemplo:** `<input type="hidden" name="csrf_token" value="abc123">`

---

## 6. Helpers — Sessão

### session(?string $key, mixed $default)
- **Descrição:** Lê valor da sessão (ou retorna toda sessão se $key = null)
- **Parâmetros:** `?string $key = null, mixed $default = null`
- **Retorno:** `mixed`
- **Exemplo:** `$user = session('user'); $all = session();`

### sessionSet(string $key, mixed $value)
- **Descrição:** Define valor na sessão
- **Parâmetros:** `string $key, mixed $value`
- **Exemplo:** `sessionSet('user', $userData);`

### sessionGet(string $key, mixed $default)
- **Descrição:** Lê valor da sessão
- **Parâmetros:** `string $key, mixed $default = null`
- **Retorno:** `mixed`

### sessionRemove(string $key)
- **Descrição:** Remove valor da sessão
- **Parâmetros:** `string $key`
- **Exemplo:** `sessionRemove('user');`

---

## 7. Helpers — Input/Forms

### inputPOST($name, $filter, $options)
- **Descrição:** Obtém dado POST seguro via filter_input
- **Parâmetros:** `string $name, int $filter = FILTER_DEFAULT, array $options = []`
- **Retorno:** `string|false|null`
- **Exemplo:** `$nome = inputPOST('nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);`

### inputGET($name, $filter, $options)
- **Descrição:** Obtém dado GET seguro via filter_input
- **Parâmetros:** `string $name, int $filter = FILTER_DEFAULT, array $options = []`
- **Retorno:** `string|false|null`

### emptyPOST($name)
- **Descrição:** Verifica se campo POST está vazio
- **Parâmetros:** `string $name`
- **Retorno:** `bool`

### emptyGET($name)
- **Descrição:** Verifica se campo GET está vazio
- **Parâmetros:** `string $name`
- **Retorno:** `bool`

### requestPOST()
- **Descrição:** Verifica se método é POST
- **Retorno:** `bool`

### requestGET()
- **Descrição:** Verifica se método é GET
- **Retorno:** `bool`

---

## 8. Helpers — Redirect

### redirect($url, $params)
- **Descrição:** Redirect HTTP (valida open redirect)
- **Parâmetros:** `string $url, mixed $params = ''`
- **Validação:** Host deve ser o mesmo, scheme deve ser http/https
- **Segurança:** Redireciona para '/' se externo

### redirectJS($url, $params)
- **Descrição:** Redirect via JavaScript
- **Parâmetros:** `string $url, mixed $params = ''`
- **Uso:** Quando headers já foram enviados

### windowAlert($message)
- **Descrição:** Alert JavaScript
- **Parâmetros:** `string $message`
- **Exemplo:** `windowAlert('Operação realizada com sucesso!');`

---

## 9. Helpers — Utilidades

### asset($path)
- **Descrição:** URL de asset com cache busting (filemtime)
- **Parâmetros:** `string $path`
- **Retorno:** `string`
- **Exemplo:** `asset('css/style.css')` → `/css/style.css?v=1725012345`
- **Nota:** Retorna path sem versão se arquivo não existir

### generatePassword($length, $upper, $num, $sym)
- **Descrição:** Gera senha segura (random_int)
- **Parâmetros:** `int $length = 8, bool $uppercase = true, bool $numbers = true, bool $symbols = false`
- **Retorno:** `string`
- **Exemplo:** `generatePassword(12, true, true, true)`

### generateSlug($text)
- **Descrição:** Gera slug amigável
- **Parâmetros:** `string $text`
- **Retorno:** `string`
- **Exemplo:** `generateSlug('Olá Mundo!')` → `ola-mundo`

### generatePrefix()
- **Descrição:** Gera prefixo aleatório de 5 caracteres
- **Retorno:** `string`
- **Exemplo:** `generatePrefix()` → `xkqbf`

### pre($value)
- **Descrição:** Debug formatado (HTML pre)
- **Parâmetros:** `mixed $value`
- **Nota:** Apenas para desenvolvimento, nunca em produção

### str_limit($str, $limit, $end)
- **Descrição:** Trunca string
- **Parâmetros:** `string $str, int $limit = 100, string $end = '...'`
- **Retorno:** `string`

### str_after($str, $search)
- **Descrição:** Busca substring após busca
- **Parâmetros:** `string $str, string $search`
- **Retorno:** `string`

### str_before($str, $search)
- **Descrição:** Busca substring antes da busca
- **Parâmetros:** `string $str, string $search`
- **Retorno:** `string`

### containsAny($haystack, $needle)
- **Descrição:** Verifica se contém algum dos termos
- **Parâmetros:** `string $haystack, array|string $needle`
- **Retorno:** `bool`

### removeAccents($value)
- **Descrição:** Remove acentos
- **Parâmetros:** `string $value`
- **Retorno:** `string`
- **Implementação:** `iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value)`

### removeSpecialChars($value)
- **Descrição:** Remove caracteres especiais
- **Parâmetros:** `string $value`
- **Retorno:** `string`

### padNumber($value)
- **Descrição:** Zero à esquerda (2 dígitos)
- **Parâmetros:** `int|string $value`
- **Retorno:** `string`
- **Exemplo:** `padNumber(5)` → `05`

### changeDate($date, $current, $new)
- **Descrição:** Converte formato de data
- **Parâmetros:** `string $date, string $currentFormat = 'd/m/Y', string $newFormat = 'Y-m-d'`
- **Retorno:** `string`
- **Exemplo:** `changeDate('30/08/2026')` → `2026-08-30`

### dayOfWeek($date, $locale)
- **Descrição:** Dia da semana por extenso (ext-intl)
- **Parâmetros:** `string $date, string $locale = 'pt_BR'`
- **Retorno:** `string`
- **Exemplo:** `dayOfWeek('2026-08-30')` → `domingo`

### monthName($month, $locale)
- **Descrição:** Nome do mês por extenso (ext-intl)
- **Parâmetros:** `int $month, string $locale = 'pt_BR'`
- **Retorno:** `string`
- **Exemplo:** `monthName(8)` → `Agosto`

### formatCurrency($value, $currency, $locale)
- **Descrição:** Formatar moeda (ext-intl)
- **Parâmetros:** `float|string $value, string $currency = 'BRL', string $locale = 'pt_BR'`
- **Retorno:** `string`
- **Exemplo:** `formatCurrency(1500.50)` → `R$ 1.500,50`

### clientLanguage()
- **Descrição:** Idioma do navegador
- **Retorno:** `string`
- **Exemplo:** `clientLanguage()` → `pt-BR`

### servername($protocolo, $semwww)
- **Descrição:** Nome do servidor
- **Retorno:** `string`

### requestURI()
- **Descrição:** URI limpa
- **Retorno:** `string`

### getClientIP()
- **Descrição:** IP do visitante (Cloudflare + proxy)
- **Retorno:** `string`
- **Prioridade:** HTTP_CF_CONNECTING_IP → HTTP_X_FORWARDED_FOR → REMOTE_ADDR

### documentroot()
- **Descrição:** Diretório raiz
- **Retorno:** `string`

---

## 10. Helpers — Arquivos (Path Traversal Protected)

### readFileContent($filename)
- **Descrição:** Lê arquivo com validação realpath
- **Parâmetros:** `string $filename`
- **Retorno:** `string`
- **Proteção:** Valida realpath() + str_starts_with() contra diretório raiz

### writeFileContent($filename, $data, $replace)
- **Descrição:** Escreve arquivo com validação
- **Parâmetros:** `string $filename, string $data, bool $replace = false`
- **Retorno:** `bool`
- **Proteção:** Valida realpath() + str_starts_with() contra diretório raiz

### deleteFile($filename)
- **Descrição:** Exclui arquivo com validação
- **Parâmetros:** `string $filename`
- **Retorno:** `bool`
- **Proteção:** Valida realpath() + str_starts_with() contra diretório raiz

### deleteDir($directory)
- **Descrição:** Exclui diretório recursivo com validação
- **Parâmetros:** `string $directory`
- **Retorno:** `bool`
- **Proteção:** Valida realpath() + str_starts_with() contra diretório raiz

### createDir($path)
- **Descrição:** Cria diretório recursivo
- **Parâmetros:** `string $path`
- **Retorno:** `bool`

---

## 11. Helpers — Rotas

### route($name, $params)
- **Descrição:** Obtém URL por nome
- **Parâmetros:** `string $name, array $params = []`
- **Retorno:** `string`
- **Exemplo:** `route('usuario.show', ['id' => 1])` → `/usuario/1`

### getURL($number)
- **Descrição:** Parte da URL atual por índice
- **Parâmetros:** `int $number`
- **Retorno:** `string`

### getLastURL()
- **Descrição:** Última parte da URL
- **Retorno:** `string`

---

## 12. Controllers

### Estrutura
```php
<?php
namespace Blumiga\controllers\home;

function index(): void {
    $titulo = 'Página';
    view('home/index', compact('titulo'), 'layout');
}
```

### Parâmetros de Rota
```php
routeGET('/usuario/{id}', 'usuario@show', 'usuario.show');
// Em usuario.php:
function show($id): void {
    $usuario = buscarPorId($id);
    view('usuario/show', compact('usuario'), 'layout');
}
```

### Namespaces
- Controllers: `Blumiga\controllers\{pasta}\{arquivo}`
- Subpastas: `Blumiga\controllers\admin\dashboard`

---

## 13. Models

### Estrutura
```php
<?php
namespace Blumiga\models\usuarioModel;

if (!defined('BLUMIGA')) exit;

function listar(): array {
    return db()->select('usuarios');
}

function buscarPorId(int $id): ?array {
    return db()->select('usuarios', '*', ['id' => $id]);
}
```

### Uso
```php
// Obter namespace do model
$ns = model('usuario');
// Retorna: \Blumiga\models\usuarioModel\

// Chamar funções com interpolação
$usuarios = "{$ns}listar"();
$usuario = "{$ns}buscarPorId"($id);
```

### Arquivo
- Localização: `app/models/{nome}Model.php`
- Namespace: `Blumiga\models\{nome}Model`

---

## 14. Views

### Renderização
```php
view('home/index');                    // Sem layout
view('home/index', $data, 'layout');  // Com layout
```

### Layout
- Arquivo: `app/views/layout.php`
- Variáveis: `$content` (injetado pelo framework), `$pageTitle`

### Escape XSS
```php
<?= e($variavel) ?>        // Escape HTML
<?= eJS($variavel) ?>      // Escape JavaScript
```

### Variáveis Disponíveis
- `$titulo` — Título da página
- `$currentPage` — URL atual (para sidebar active)
- `$content` — Conteúdo renderizado (no layout)
- Qualquer variável passada via `compact()`

---

## 15. Rotas

### Definição
```php
routeGET('/', 'home@index', 'home');
routeGET('/usuario/{id}', 'usuario@show', 'usuario.show');
routePOST('/login', 'auth@logar', 'login.logar');

routeGROUP('/admin', 'Admin', function () {
    routeGET('/', 'dashboard@index', 'admin.home');
}, ['auth@run', 'log@run']);

route404(function () { view('errors/404'); });
```

### Parâmetros
- `{id}` — Parâmetro simples
- `{id:[0-9]+}` — Com regex
- `{slug:[a-z-]+}` — Com padrão

### Rotas Nomeadas
```php
redirect(route('dashboard'));
redirect(route('usuario.show', ['id' => 1]));
```

### Formato Controller@metodo
- `home@index` → `app/controllers/home.php` → função `index()`
- `usuario@show` → `app/controllers/usuario.php` → função `show($id)`
- Subpastas: `admin/dashboard@index` → `app/controllers/admin/dashboard.php`

---

## 16. Segurança Implementada

### Headers HTTP
- `X-Content-Type-Options: nosniff`
- `X-Frame-Options: DENY`
- `Referrer-Policy: strict-origin-when-cross-origin`
- `Permissions-Policy: camera=(), microphone=(), geolocation=()`
- `Content-Security-Policy` (configurável)
- `Strict-Transport-Security: max-age=31536000`
- `X-XSS-Protection: 1; mode=block`
- `Cross-Origin-Opener-Policy: same-origin`
- `Cross-Origin-Resource-Policy: same-origin`

### Sessão
- `cookie_httponly = 1` — Impede acesso via JS
- `cookie_secure = 1` — Apenas HTTPS
- `cookie_samesite = Lax` — Proteção CSRF básica
- `use_strict_mode = 1` — Rejeita IDs inválidos
- `use_only_cookies = 1` — Sem session ID na URL
- `use_trans_sid = 0` — Desabilita session ID transparente
- `sid_length = 48` — Tamanho do session ID
- `sid_bits_per_character = 6` — Complexidade

### Criptografia
- AES-256-CBC + HMAC-SHA256 (encrypt-then-MAC)
- Chaves derivadas via hash_hmac (separação enc/mac)
- Verificação timing-safe com hash_equals()

---

## 17. CLI — Comandos

| Comando | Descrição |
|---------|-----------|
| `serve [porta]` | Servidor dev (padrão: 8080, validação 1-65535) |
| `make:controller nome` | Criar controller (suporta subpastas: admin/dashboard) |
| `make:model nome` | Criar model |
| `make:view nome` | Criar view (suporta subpastas) |
| `make:middleware nome` | Criar middleware |
| `make:migration nome` | Criar migration |
| `make:seeder nome` | Criar seeder |
| `migrate` | Executar migrations (up) |
| `migrate:rollback` | Reverter migrations (down, ordem reversa) |
| `db:seed [nome]` | Executar seeders (run) |
| `db:seed:rollback [nome]` | Reverter seeders (down) |
| `route:list` | Listar rotas registradas |
| `clear:cache` | Limpar OPcache + storage/cache |
| `version` | Versão do composer.json |
| `key:generate [tamanho]` | Gerar chave de criptografia (16-128 bytes) |
| `help` | Menu de ajuda |

### Validação de Nomes (CLI)

A função `validarNomeArquivo()` sanitiza: apenas `[a-zA-Z0-9_\/]`, remove `..`, barra inicial/final.

---

## 18. Composer Scripts

| Script | Descrição |
|--------|-----------|
| `composer test` | Todos os testes (99 tests, 123 assertions) |
| `composer test:security` | Testes de segurança (48 tests) |
| `composer test:error` | Testes de erros (7 tests) |
| `composer test:unit` | Testes unitários (46 tests) |
| `composer analyse` | PHPStan nível 5 (0 erros) |

---

## 19. Notas para Agentes

### Segurança
1. **Sempre usar `e()`** em variáveis do usuário/banco (XSS)
2. **Sempre usar `eJS()`** em contexto JavaScript
3. **Usar `realpath()` + `str_starts_with()`** para acesso a arquivos
4. **Não usar `extract()` com `EXTR_OVERWRITE`** (manter `EXTR_SKIP`)
5. **Não expor detalhes de erro** ao usuário (usar `error_log()`)
6. **Usar domínios fictícios** em testes: `teste.localhost`
7. **Usar IPs fictícios** em testes: `0.0.0.0`, `100.100.100.100`

### Padrões
8. **Usar `declare(strict_types=1)`** em todos os arquivos PHP
9. **Manter `if (!defined('BLUMIGA')) exit;`** em views e models
10. **Usar `compact()`** para passar variáveis para views
11. **Definir nome em rotas** que precisam de `redirect(route('nome'))`

### Testing
12. **Rodar `composer test`** antes de commitar
13. **Não testar com `die()`/`exit()`** — usar `simulateRedirect()` ou `ob_start()`
14. **Suprimir `trigger_error()` esperado** com `@` para evitar warning no PHPUnit

### Rotas
15. **Usar formato `controller@metodo`**
16. **Aplicar middlewares em grupos**, não individualmente quando possível
17. **Usar `route()`** para links, não hardcoded URLs

### Models
18. **Pattern:** `model('nome')` retorna namespace → `"{$ns}funcao"()`
19. **Arquivo:** `app/models/{nome}Model.php`
20. **Funções:** públicas com namespaces

### Views
21. **Layout:** `app/views/layout.php` com `$content` e `$pageTitle`
22. **Variáveis:** `$titulo`, `$currentPage`, `$content`
23. **Escape:** `<?= e($var) ?>` e `<?= eJS($var) ?>`

### Controllers
24. **Namespace:** `Blumiga\controllers\{pasta}\{arquivo}`
25. **Função padrão:** `index()`
26. **Parâmetros:** Recebidos da rota como argumentos

### Middleware
27. **Namespace:** `Blumiga\middleware\{arquivo}`
28. **Função:** `run(callable $next, mixed $param = null): void`
29. **Uso:** Array de middlewares na definição da rota

### Configuração
30. **Arquivo:** `config/config.php` (não commitado)
31. **Variáveis:** `$blumigaDev`, `$dbConfig`, `$sessionName`, `$sessionConfig`, `$headersConfig`
32. **Whitelists:** Headers e sessão validados em `public/index.php`

### Constante Global
33. **Constante:** `BLUMIGA` (definida em `public/index.php` e `blumiga`)
34. **Proteção:** `if (!defined('BLUMIGA')) exit;`

### Fluxo de Execução
35. **Web:** `index.php → config.php → session → core/app.php → functions.php → route.php → routes.php → dispatchRoute()`
36. **CLI:** `blumiga → config.php → vendor/autoload.php → switch(comando)`

### Estrutura de Diretórios
37. **Controllers:** `app/controllers/`
38. **Models:** `app/models/`
39. **Views:** `app/views/`
40. **Middleware:** `app/middleware/`
41. **Config:** `config/`
42. **Core:** `core/`
43. **Libs:** `libs/`
44. **Public:** `public/`
45. **Storage:** `storage/`
46. **Tests:** `tests/`
47. **Vendor:** `vendor/`
