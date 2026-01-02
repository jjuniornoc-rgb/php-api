# Testes da API

## Testar se a API está funcionando

### 1. Teste básico (Home)
```bash
curl http://seu-dominio.com/
```

### 2. Listar usuários
```bash
curl http://seu-dominio.com/api/users
```

### 3. Criar usuário
```bash
curl -X POST http://seu-dominio.com/api/users \
  -H "Content-Type: application/json" \
  -d '{"name":"Teste","email":"teste@example.com"}'
```

### 4. Buscar usuário por ID
```bash
curl http://seu-dominio.com/api/users/1
```

## Verificar logs do Apache

Se houver problemas, verifique os logs:
```bash
tail -f /var/log/apache2/error.log
```

## Status da API

Se tudo estiver funcionando, você deve receber respostas JSON como:

```json
{
    "success": true,
    "message": "API funcionando corretamente",
    "data": {...}
}
```

