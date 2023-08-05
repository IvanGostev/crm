<?php

namespace App\models\todo;

use Database\Database;
class Task
{
    private \PDO $db;
    public array $status = ['New' => 'new', 'In progress' => 'in_progress', 'Completed' => 'completed', 'On hold' => 'on_hold', 'Cancelled' => 'cancelled'];
    public array $priority = ['Low' => 'low', 'Medium' => 'medium', 'High' => 'high', 'Urgent' => 'urgent'];

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT * FROM `todo_tasks`");
        } catch (\PDOException $exception) {
            $this->createTable();
        }
    }

    public function createLikes() {
        
    }
    private function createTable(): bool
    {
        try {
            $stmt = $this->db->prepare("CREATE TABLE IF NOT EXISTS `todo_tasks` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `user_id` INT(11) NOT NULL,
    `category_id` INT(11),
    `status` ENUM('new', 'in_progress', 'completed', 'on_hold', 'cancelled') NOT NULL,
    `priority` ENUM('low', 'medium', 'high', 'urgent') NOT NULL,
    `completed_at` TIMESTAMP,
    `reminder_at` TIMESTAMP,
    `finish_date` TIMESTAMP,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
     FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
     FOREIGN KEY (`category_id`) REFERENCES `todo_categories`(`id`) ON DELETE SET NULL
)");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function readAllAdmin(): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_tasks` ");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function readAll($data): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM todo_tasks WHERE user_id = ? AND finish_date > NOW() AND status != 'completed' ORDER BY ABS(TIMESTAMPDIFF(SECOND, NOW(), finish_date))");
            $stmt->execute([$data['user_id'] ?? 0]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function readAllCompleted($data): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM todo_tasks WHERE user_id = ? AND status = 'completed' ORDER BY ABS(TIMESTAMPDIFF(SECOND, NOW(), finish_date))");
            $stmt->execute([$data['user_id'] ?? 0]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function readAllExpired($data): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM todo_tasks WHERE user_id = ? AND finish_date < NOW() ORDER BY ABS(TIMESTAMPDIFF(SECOND, NOW(), finish_date))");
            $stmt->execute([$data['user_id'] ?? 0]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function store(array $data): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `todo_tasks` (title, category_id, user_id, finish_date, status, priority) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$data['title'], $data['category_id'], $data['user_id'] ?? 0, $data['finish_date'], 'new', 'medium']);
            return true;
        } catch (\PDOException $exception) {
            tte($exception->getMessage());
            return false;
        }
    }


    public function edit(int $id): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_tasks` WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function update(array $data): bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE `todo_tasks` SET title = ?, description = ?, category_id = ?, status = ?, priority = ?, reminder_at = ?, finish_date = ?  WHERE id = ?");
            $stmt->execute([$data['title'], $data['description'], $data['category_id'], $data['status'], $data['priority'], $data['reminder_at'], $data['finish_date'], $data['id']]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `todo_tasks` WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getTasksByTag(array $data) : array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT todo_tasks.* FROM todo_tasks
JOIN todo_tasks_tags ON todo_tasks.id = todo_tasks_tags.task_id
WHERE todo_tasks_tags.tag_id = ? AND todo_tasks.user_id = ?;");
            $stmt->execute([$data['tag_id'], $data['user_id'] ?? 0]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getTaskById($data) : array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_tasks` WHERE id = ? AND user_id = ?");
            $stmt->execute([$data['id'], $data['user_id'] ?? 0]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function updateStatusById(array $data) : bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE `todo_tasks` SET status = ?  WHERE id = ? AND user_id = ?");
            $stmt->execute([$data['status'], $data['id'], $data['user_id'] ?? 0]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

}


