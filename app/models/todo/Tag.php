<?php

namespace App\models\todo;

use Database\Database;

class Tag
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT * FROM `todo_tasks_tags`");
        } catch (\PDOException $exception) {
            $this->createTables();
        }
    }

    private function createTables(): void
    {
        if ($this->createTableTodoTags()) {
            $this->createTableTodoTasksTags();
        }
    }

    private function createTableTodoTags(): bool
    {
        try {
            $stmt = $this->db->prepare("CREATE TABLE IF NOT EXISTS `todo_tags` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(11) NOT NULL,
    `title` VARCHAR(255), 
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
      )");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    private function createTableTodoTasksTags(): bool
    {
        try {
            $stmt = $this->db->prepare("CREATE TABLE IF NOT EXISTS `todo_tasks_tags` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `task_id` INT(11) NOT NULL,
    `tag_id` INT(11) NOT NULL,
    FOREIGN KEY (`task_id`) REFERENCES `todo_tasks`(`id`),
    FOREIGN KEY (`tag_id`) REFERENCES `todo_tags`(`id`) ON DELETE CASCADE
)");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getTagsByTaskId(int $task_id): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT todo_tags.* FROM todo_tags
    JOIN todo_tasks_tags ON todo_tags.id = todo_tasks_tags.tag_id
    WHERE todo_tasks_tags.task_id = :task_id");
            $stmt->execute(['task_id' => $task_id]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function removeAllTaskTag(int $task_id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `todo_tasks_tags` WHERE task_id = ?");
            $stmt->execute([$task_id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getTagByNameAndUserId(string $title, int $user_id): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_tags` WHERE title = ? AND user_id = ?;");
            $stmt->execute([$title, $user_id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function addTag(string $title, int $user_id): array|bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `todo_tags` (title, user_id) VALUES ( ?, ?)");
            $stmt->execute([$title, $user_id]);
            return $this->getTagByNameAndUserId($title, $user_id);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function addTaskTag(int $task_id, int $tag_id): int|bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `todo_tasks_tags` (task_id, tag_id) VALUES ( ?, ?)");
            $stmt->execute([$task_id, $tag_id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function removeUnusedTag(int $tag_id): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM `todo_tasks_tags` WHERE tag_id = ?");
            $stmt->execute([$tag_id]);
            $count = $stmt->fetch(\PDO::FETCH_ASSOC)['COUNT(*)'];
            if ($count == 0) {
                $stmt = $this->db->prepare("DELETE FROM `todo_tags` WHERE id = ?");
                $stmt->execute([$tag_id]);
            }
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getTagTitleById(int $id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `todo_tags` WHERE id = ?;");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC)['title'];
        } catch (\PDOException $exception) {
            return false;
        }
    }
}


