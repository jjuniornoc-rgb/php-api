# API PHP RESTful

API RESTful moderna desenvolvida em PHP com estrutura organizada e boas práticas. **Sem banco de dados** - utiliza armazenamento em memória para simplicidade.

## 📁 Estrutura do Projeto

```
php/
├── app/
│   ├── Core/
│   │   ├── Router.php       # Sistema de rotas
│   │   ├── Request.php      # Classe de requisição
│   │   └── Response.php     # Classe de resposta
│   └── Controllers/
│       ├── BaseController.php
│       ├── HomeController.php
│       └── UserController.php
├── config/
│   ├── env.php              # Configurações do ambiente
│   └── env.example.php      # Exemplo de configurações
├── public/
│   ├── index.php            # Ponto de entrada da aplicação
│   └── .htaccess            # Configuração Apache (opcional)
├── routes/
│   └── api.php              # Definição de rotas
├── .env                     # Variáveis de ambiente (criar manualmente)
├── composer.json            # Dependências do projeto
├── .gitignore               # Arquivos ignorados pelo Git
└── README.md
```

## 🚀 Instalação

### 1. Instalar dependências

```bash
composer install
```

### 2. Configurar ambiente (opcional)

Copie o conteúdo de `env-example.txt` para um arquivo `.env` na raiz do projeto:

```env
APP_NAME=PHP_API
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost
JWT_SECRET=your-secret-key-here-change-in-production
JWT_EXPIRATION=3600
SERVER_PORT=8000
```

### 3. Iniciar servidor

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

**Nota:** Os dados são armazenados em memória e serão perdidos ao reiniciar o servidor.

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
- Dotenv

## 📦 Dependências

- `vlucas/phpdotenv` - Gerenciamento de variáveis de ambiente

## 💡 Características

- ✅ Estrutura MVC organizada
- ✅ Sistema de rotas RESTful
- ✅ Validação de dados
- ✅ Respostas JSON padronizadas
- ✅ CORS configurado
- ✅ Sem banco de dados (armazenamento em memória)
- ✅ Fácil de expandir e personalizar

## 🔒 Segurança

- Configure o arquivo `.env` com valores seguros em produção
- Altere o `JWT_SECRET` para um valor aleatório forte
- Configure `APP_DEBUG=false` em produção
- Use HTTPS em produção

## 📄 Licença

Este projeto é de código aberto e está disponível sob a licença MIT.
