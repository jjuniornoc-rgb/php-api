# API PHP RESTful

API RESTful moderna desenvolvida em PHP com estrutura organizada e boas práticas.

## 📁 Estrutura do Projeto

```
php/
├── app/
│   ├── Core/
│   │   ├── Router.php       # Sistema de rotas
│   │   ├── Request.php      # Classe de requisição
│   │   ├── Response.php     # Classe de resposta
│   │   └── Database.php     # Conexão com banco de dados
│   ├── Controllers/
│   │   ├── BaseController.php
│   │   ├── HomeController.php
│   │   └── UserController.php
│   └── Models/
│       └── User.php         # Model de exemplo
├── config/
│   ├── env.php              # Configurações do ambiente
│   └── env.example.php      # Exemplo de configurações
├── database/
│   └── migrations/
│       └── create_users_table.sql
├── public/
│   ├── index.php            # Ponto de entrada da aplicação
│   └── .htaccess            # Configuração Apache (opcional)
├── routes/
│   └── api.php              # Definição de rotas
├── .env                     # Variáveis de ambiente (criar manualmente)
├── .env.example             # Exemplo de variáveis de ambiente
├── composer.json            # Dependências do projeto
├── .gitignore               # Arquivos ignorados pelo Git
├── README.md
└── INSTALACAO.md            # Guia de instalação detalhado
```

## 🚀 Instalação

### 1. Instalar dependências

```bash
composer install
```

### 2. Configurar ambiente

Copie o arquivo `.env.example` para `.env` e configure as variáveis:

```bash
cp .env.example .env
```

Edite o arquivo `.env` com suas configurações:

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=api_db
DB_USER=root
DB_PASS=sua_senha
```

### 3. Criar banco de dados

Execute o script SQL em `database/migrations/create_users_table.sql` no seu banco de dados MySQL.

### 4. Iniciar servidor

```bash
composer serve
```

Ou usando PHP diretamente:

```bash
php -S localhost:8000 -t public
```

A API estará disponível em: `http://localhost:8000`

## 📚 Endpoints

### Home
- `GET /` - Informações da API

### Usuários
- `GET /api/users` - Listar todos os usuários
- `GET /api/users/{id}` - Buscar usuário por ID
- `POST /api/users` - Criar novo usuário
- `PUT /api/users/{id}` - Atualizar usuário
- `DELETE /api/users/{id}` - Deletar usuário

## 📝 Exemplos de Uso

### Listar usuários
```bash
curl http://localhost:8000/api/users
```

### Criar usuário
```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{"name":"João Silva","email":"joao@example.com"}'
```

### Buscar usuário
```bash
curl http://localhost:8000/api/users/1
```

### Atualizar usuário
```bash
curl -X PUT http://localhost:8000/api/users/1 \
  -H "Content-Type: application/json" \
  -d '{"name":"João Santos"}'
```

### Deletar usuário
```bash
curl -X DELETE http://localhost:8000/api/users/1
```

## 🛠️ Tecnologias

- PHP 7.4+
- Composer
- MySQL
- PDO
- Dotenv

## 📦 Dependências

- `vlucas/phpdotenv` - Gerenciamento de variáveis de ambiente

## 🔒 Segurança

- Configure o arquivo `.env` com valores seguros em produção
- Altere o `JWT_SECRET` para um valor aleatório forte
- Configure `APP_DEBUG=false` em produção
- Use HTTPS em produção

## 📄 Licença

Este projeto é de código aberto e está disponível sob a licença MIT.

