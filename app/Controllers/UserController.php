<?php

namespace App\Controllers;

use App\Core\Request;

class UserController extends BaseController
{
    // Armazenamento em memória (simulado)
    private static $users = [
        ['id' => 1, 'name' => 'João Silva', 'email' => 'joao@example.com', 'created_at' => '2024-01-01 10:00:00'],
        ['id' => 2, 'name' => 'Maria Santos', 'email' => 'maria@example.com', 'created_at' => '2024-01-02 11:00:00'],
        ['id' => 3, 'name' => 'Pedro Oliveira', 'email' => 'pedro@example.com', 'created_at' => '2024-01-03 12:00:00']
    ];

    public function index(Request $request)
    {
        $this->success(self::$users, 'Usuários listados com sucesso');
    }

    public function show(Request $request)
    {
        $id = (int) $request->getParam(0);
        
        $user = $this->findUserById($id);

        if (!$user) {
            $this->notFound('Usuário não encontrado');
            return;
        }

        $this->success($user, 'Usuário encontrado');
    }

    public function store(Request $request)
    {
        $data = $request->getBody();

        $this->validate($data, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:100'
        ]);

        // Gerar novo ID
        $newId = count(self::$users) > 0 ? max(array_column(self::$users, 'id')) + 1 : 1;

        $user = [
            'id' => $newId,
            'name' => $data['name'],
            'email' => $data['email'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        self::$users[] = $user;

        $this->success($user, 'Usuário criado com sucesso', 201);
    }

    public function update(Request $request)
    {
        $id = (int) $request->getParam(0);
        $data = $request->getBody();

        $this->validate($data, [
            'name' => 'min:3|max:100',
            'email' => 'email|max:100'
        ]);

        $userIndex = $this->findUserIndexById($id);

        if ($userIndex === false) {
            $this->notFound('Usuário não encontrado');
            return;
        }

        if (isset($data['name'])) {
            self::$users[$userIndex]['name'] = $data['name'];
        }

        if (isset($data['email'])) {
            self::$users[$userIndex]['email'] = $data['email'];
        }

        $this->success(self::$users[$userIndex], 'Usuário atualizado com sucesso');
    }

    public function destroy(Request $request)
    {
        $id = (int) $request->getParam(0);

        $userIndex = $this->findUserIndexById($id);

        if ($userIndex === false) {
            $this->notFound('Usuário não encontrado');
            return;
        }

        unset(self::$users[$userIndex]);
        self::$users = array_values(self::$users); // Reindexar array

        $this->success(null, 'Usuário deletado com sucesso');
    }

    private function findUserById($id)
    {
        foreach (self::$users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }
        return null;
    }

    private function findUserIndexById($id)
    {
        foreach (self::$users as $index => $user) {
            if ($user['id'] === $id) {
                return $index;
            }
        }
        return false;
    }
}
