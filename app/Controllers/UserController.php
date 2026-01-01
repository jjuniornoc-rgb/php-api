<?php

namespace App\Controllers;

use App\Core\Request;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        try {
            $users = $this->db->fetchAll("SELECT id, name, email, created_at FROM users ORDER BY id DESC");
            $this->success($users, 'Usuários listados com sucesso');
        } catch (\Exception $e) {
            $this->error('Erro ao listar usuários: ' . $e->getMessage(), 500);
        }
    }

    public function show(Request $request)
    {
        $id = $request->getParam(0);

        try {
            $user = $this->db->fetchOne("SELECT id, name, email, created_at FROM users WHERE id = ?", [$id]);

            if (!$user) {
                $this->notFound('Usuário não encontrado');
                return;
            }

            $this->success($user, 'Usuário encontrado');
        } catch (\Exception $e) {
            $this->error('Erro ao buscar usuário: ' . $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->getBody();

        $this->validate($data, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:100'
        ]);

        try {
            $this->db->query(
                "INSERT INTO users (name, email, created_at) VALUES (?, ?, NOW())",
                [$data['name'], $data['email']]
            );

            $userId = $this->db->lastInsertId();
            $user = $this->db->fetchOne("SELECT id, name, email, created_at FROM users WHERE id = ?", [$userId]);

            $this->success($user, 'Usuário criado com sucesso', 201);
        } catch (\Exception $e) {
            $this->error('Erro ao criar usuário: ' . $e->getMessage(), 500);
        }
    }

    public function update(Request $request)
    {
        $id = $request->getParam(0);
        $data = $request->getBody();

        $this->validate($data, [
            'name' => 'min:3|max:100',
            'email' => 'email|max:100'
        ]);

        try {
            $user = $this->db->fetchOne("SELECT id FROM users WHERE id = ?", [$id]);

            if (!$user) {
                $this->notFound('Usuário não encontrado');
                return;
            }

            $updates = [];
            $params = [];

            if (isset($data['name'])) {
                $updates[] = "name = ?";
                $params[] = $data['name'];
            }

            if (isset($data['email'])) {
                $updates[] = "email = ?";
                $params[] = $data['email'];
            }

            if (!empty($updates)) {
                $params[] = $id;
                $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
                $this->db->query($sql, $params);
            }

            $user = $this->db->fetchOne("SELECT id, name, email, created_at FROM users WHERE id = ?", [$id]);
            $this->success($user, 'Usuário atualizado com sucesso');
        } catch (\Exception $e) {
            $this->error('Erro ao atualizar usuário: ' . $e->getMessage(), 500);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->getParam(0);

        try {
            $user = $this->db->fetchOne("SELECT id FROM users WHERE id = ?", [$id]);

            if (!$user) {
                $this->notFound('Usuário não encontrado');
                return;
            }

            $this->db->query("DELETE FROM users WHERE id = ?", [$id]);
            $this->success(null, 'Usuário deletado com sucesso');
        } catch (\Exception $e) {
            $this->error('Erro ao deletar usuário: ' . $e->getMessage(), 500);
        }
    }
}

