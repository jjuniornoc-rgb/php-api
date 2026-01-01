<?php

namespace App\Controllers;

use App\Core\Request;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $this->success([
            'message' => 'Bem-vindo à API PHP',
            'version' => '1.0.0',
            'endpoints' => [
                'GET /api/users' => 'Listar todos os usuários',
                'GET /api/users/{id}' => 'Buscar usuário por ID',
                'POST /api/users' => 'Criar novo usuário',
                'PUT /api/users/{id}' => 'Atualizar usuário',
                'DELETE /api/users/{id}' => 'Deletar usuário'
            ]
        ], 'API funcionando corretamente');
    }
}

