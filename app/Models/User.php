<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findAll()
    {
        return $this->db->fetchAll("SELECT id, name, email, created_at FROM users ORDER BY id DESC");
    }

    public function findById($id)
    {
        return $this->db->fetchOne("SELECT id, name, email, created_at FROM users WHERE id = ?", [$id]);
    }

    public function create($data)
    {
        $this->db->query(
            "INSERT INTO users (name, email, created_at) VALUES (?, ?, NOW())",
            [$data['name'], $data['email']]
        );
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
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

        return $this->findById($id);
    }

    public function delete($id)
    {
        return $this->db->query("DELETE FROM users WHERE id = ?", [$id]);
    }

    public function exists($id)
    {
        $user = $this->db->fetchOne("SELECT id FROM users WHERE id = ?", [$id]);
        return $user !== false;
    }
}

