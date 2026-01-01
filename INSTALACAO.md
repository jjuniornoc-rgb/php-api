# Guia de Instalação

## Passo a Passo

### 1. Instalar Composer (se ainda não tiver)

Baixe e instale o Composer: https://getcomposer.org/download/

### 2. Instalar Dependências

```bash
composer install
```

### 3. Criar Arquivo .env

Crie um arquivo `.env` na raiz do projeto com o seguinte conteúdo:

```env
# Configurações do Ambiente
APP_NAME=PHP_API
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost

# Configurações do Banco de Dados
DB_HOST=localhost
DB_PORT=3306
DB_NAME=api_db
DB_USER=root
DB_PASS=

# Configurações de Segurança
JWT_SECRET=your-secret-key-here-change-in-production
JWT_EXPIRATION=3600

# Configurações do Servidor
SERVER_PORT=8000
```

**Importante:** Ajuste as configurações do banco de dados conforme seu ambiente.

### 4. Criar Banco de Dados

Execute o script SQL em `database/migrations/create_users_table.sql` no seu MySQL:

```sql
CREATE DATABASE api_db;

USE api_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 5. Iniciar o Servidor

```bash
composer serve
```

Ou:

```bash
php -S localhost:8000 -t public
```

### 6. Testar a API

Acesse: `http://localhost:8000`

Você deve ver uma resposta JSON com informações da API.

## Estrutura de Pastas Criada

```
php/
├── app/
│   ├── Core/              # Classes core do framework
│   └── Controllers/       # Controllers da aplicação
├── config/                # Arquivos de configuração
├── database/
│   └── migrations/        # Scripts SQL
├── public/                # Ponto de entrada (index.php)
└── routes/                # Definição de rotas
```

## Próximos Passos

- Adicione mais controllers conforme necessário
- Crie models na pasta `app/Models/`
- Adicione middleware em `app/Middleware/`
- Configure autenticação JWT se necessário

