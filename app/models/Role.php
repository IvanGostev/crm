<?php

namespace App\models;
use Database\Database;
class Role
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT * FROM `roles`");
        } catch (\PDOException $exception) {
            $this->createTable();
        }
    }

    private function createTable(): bool
    {
        try {
            $stmt = $this->db->prepare("CREATE TABLE IF NOT EXISTS `roles` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT
)");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function readAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `roles`");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function store(array $data): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `roles` (name, description) VALUES (?, ?)");
            $stmt->execute([$data['name'], $data['description']]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }


    public function edit(int $id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `roles` WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE `roles` SET name = ?, description = ? WHERE id = ?");
            $stmt->execute([$data['name'], $data['description'], $id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `roles` WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

}


