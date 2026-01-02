# Guia de Instalação

## Passo a Passo

### 1. Instalar Composer (se ainda não tiver)

Baixe e instale o Composer: https://getcomposer.org/download/

### 2. Instalar Dependências

```bash
composer install
```

### 3. Criar Arquivo .env (Opcional)

Crie um arquivo `.env` na raiz do projeto com o seguinte conteúdo:

```env
# Configurações do Ambiente
APP_NAME=PHP_API
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost

# Configurações de Segurança
JWT_SECRET=your-secret-key-here-change-in-production
JWT_EXPIRATION=3600

# Configurações do Servidor
SERVER_PORT=8000
```

**Nota:** O arquivo `.env` é opcional. A API funciona sem ele, mas é recomendado para configurações personalizadas.

### 4. Iniciar o Servidor

```bash
composer serve
```

Ou:

```bash
php -S localhost:8000 -t public
```

### 5. Testar a API

Acesse: `http://localhost:8000`

Você deve ver uma resposta JSON com informações da API.

## Estrutura de Pastas

```
php/
├── app/
│   ├── Core/              # Classes core do framework
│   │   ├── Router.php     # Sistema de rotas
│   │   ├── Request.php    # Classe de requisição
│   │   └── Response.php   # Classe de resposta
│   └── Controllers/       # Controllers da aplicação
├── config/                # Arquivos de configuração
├── public/                # Ponto de entrada (index.php)
└── routes/                # Definição de rotas
```

## ⚠️ Importante

- **Sem banco de dados:** Esta API utiliza armazenamento em memória. Os dados serão perdidos ao reiniciar o servidor.
- **Para produção:** Considere adicionar um banco de dados ou sistema de persistência se necessário.

## Próximos Passos

- Adicione mais controllers conforme necessário
- Adicione middleware em `app/Middleware/`
- Configure autenticação JWT se necessário
- Adicione um banco de dados se precisar de persistência
