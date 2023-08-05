<?php

namespace App\models\todo;
use Database\Database;

class Category
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT * FROM `todo_categories`");
        } catch (\PDOException $exception) {
            $this->createTable();
        }
    }

    private function createTable(): bool
    {
        try {
            $stmt = $this->db->prepare("CREATE TABLE IF NOT EXISTS `todo_categories` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `usability` TINYINT DEFAULT 1,
    `user_id` INT(11) NOT NULL,
     FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
)");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function readAll(): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_categories`");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function store(array $data): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `todo_categories` (title, description, user_id) VALUES (?, ?, ?)");
            $stmt->execute([$data['title'], $data['description'], $data['userId']]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }


    public function edit(int $id): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_categories` WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function update(array $data): bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE `todo_categories` SET title = ?, description = ?, usability = ? WHERE id = ?");
            $stmt->execute([$data['title'], $data['description'], $data['usability'], $data['id']]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `todo_categories` WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            tt($exception->getMessage());
            return false;
        }
    }
    public function findCategoriesWithUsability() : array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_categories` WHERE usability = ?");
            $stmt->execute([1]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            tt($exception->getMessage());
            return false;
        }
    }
    public function getCategoryById($data) : array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_categories` WHERE id = ? AND user_id = ?");
            $stmt->execute([$data['id'], $data['user_id']]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }


}


