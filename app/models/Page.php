<?php

namespace App\models;
use App\models\Role;
use Database\Database;

class Page
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT * FROM `pages`");
        } catch (\PDOException $exception) {
            $this->createTable();
            $this->insertPages();
        }
    }

    private function createTable(): bool
    {
        try {
            $stmt = $this->db->prepare("CREATE TABLE IF NOT EXISTS `pages` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `roles` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }
    private function insertPages() : bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `pages` (`id`, `title`, `slug`, `roles`, `created_at`, `updated_at`) VALUES
        (1, 'Home', '/', '1,2,3,4,5', '2023-03-30 10:22:01', '2023-03-30 12:16:30'),
        (2, 'Users', 'users', '1,2,5', '2023-03-30 10:25:20', '2023-03-30 11:31:04'),
        (3, 'Pages', 'pages', '5', '2023-03-30 10:55:54', '2023-03-30 10:55:54'),
        (4, 'User edit', 'users/edit', '2,5', '2023-03-30 11:33:37', '2023-03-30 11:59:39'),
        (5, 'User create', 'users/create', '3,4,5', '2023-03-30 12:08:29', '2023-03-30 12:09:38'),
        (6, 'Users store', 'users/store', '3,4,5', '2023-03-30 12:11:08', '2023-03-30 12:11:08'),
        (7, 'Users update', 'users/update', '5', '2023-03-30 12:11:45', '2023-03-30 12:11:45'),
        (8, 'Roles', 'roles', '2,3,4,5', '2023-03-30 12:12:24', '2023-03-30 12:12:24'),
        (9, 'Roles create', 'roles/create', '3,4,5', '2023-03-30 12:12:48', '2023-03-30 12:12:48'),
        (10, 'Roles store', 'roles/store', '3,4,5', '2023-03-30 12:13:14', '2023-03-30 12:13:14'),
        (11, 'Roles edit', 'roles/edit', '3,4,5', '2023-03-30 12:13:50', '2023-03-30 12:13:50'),
        (12, 'Roles update', 'roles/update', '5', '2023-03-30 12:14:16', '2023-03-30 12:14:16'),
        (13, 'Pages update', 'pages/update', '5', '2023-03-30 12:16:20', '2023-03-30 12:16:20'),
        (14, 'Users delete', 'users/delete', '5', '2023-03-30 12:18:32', '2023-03-30 12:18:32'),
        (15, 'Todo category create', 'todo/categories/create', '3,4,5', '2023-03-30 20:13:55', '2023-03-30 20:13:55'),
        (16, 'Todo category edit', 'todo/categories/edit', '3,4,5', '2023-03-30 20:14:27', '2023-03-30 20:14:27'),
        (17, 'Todo category', 'todo/categories', '3,4,5', '2023-03-30 20:15:41', '2023-03-30 20:15:41'),
        (18, 'Todo category store', 'todo/categories/store', '3,4,5', '2023-03-30 20:16:46', '2023-03-30 20:16:46'),
        (19, 'Todo category delete', 'todo/categories/delete', '3,4,5', '2023-03-30 20:17:09', '2023-03-30 20:17:09'),
        (20, 'Todo category update', 'todo/categories/update', '3,4,5', '2023-03-30 20:17:45', '2023-03-30 20:17:45'),
        (21, 'Tasks', 'todo/tasks', '3,4,5', '2023-04-02 15:51:40', '2023-04-02 15:51:40'),
        (22, 'Task create', 'todo/tasks/create', '3,4,5', '2023-04-02 15:53:46', '2023-04-02 15:54:38'),
        (23, 'Todo task store', 'todo/tasks/store', '3,4,5', '2023-04-02 18:31:50', '2023-04-02 18:31:50'),
        (24, 'Tasks update', 'todo/tasks/update', '3,4,5', '2023-04-03 17:53:55', '2023-04-03 17:53:55'),
        (25, 'Tasks delete', 'todo/tasks/delete', '3,4,5', '2023-04-03 17:54:19', '2023-04-03 17:54:19'),
        (26, 'Tasks edit', 'todo/tasks/edit', '3,4,5', '2023-04-03 17:54:44', '2023-04-03 17:54:44'),
        (27, 'Tasks completed', 'todo/tasks/completed', '3,4,5', '2023-04-04 20:50:23', '2023-04-04 20:50:23'),
        (28, 'Expired tasks', 'todo/tasks/expired', '3,4,5', '2023-04-04 21:23:19', '2023-04-04 21:23:19'),
        (29, 'Pages create', 'pages/create', '5', '2023-04-12 11:30:12', '2023-04-12 11:30:27'),
        (30, 'Pages edit', 'pages/edit', '5', '2023-04-12 11:30:53', '2023-04-12 11:30:53'),
        (31, 'Pages delete', 'pages/delete', '5', '2023-04-12 11:31:05', '2023-04-12 11:31:05'),
        (32, 'Pages store', 'pages/store', '5', '2023-04-13 13:56:39', '2023-04-13 13:56:39'),
        (33, 'Roles delete', 'roles/delete', '5', '2023-04-13 13:57:27', '2023-04-13 13:57:27'),
        (34, 'Todo tasks task', 'todo/tasks/show', '2,3,4,5', '2023-04-13 13:59:59', '2023-04-13 14:01:02'),
        (35, 'Todo tasks  by tag', 'todo/tasks/by-tag', '2,3,4,5', '2023-04-13 14:00:48', '2023-04-13 14:00:48');");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }
    public function readAll(): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `pages`");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function store(array $data): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `pages` (title, slug, roles) VALUES (?, ?, ?)");
            $stmt->execute([$data['title'], $data['slug'], $data['roles']]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }


    public function edit(int $id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `pages` WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE `pages` SET title = ?, slug = ?, roles = ? WHERE id = ?");
            $stmt->execute([$data['title'], $data['slug'], $data['roles'], $id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `pages` WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function findBySlug(string $slug)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `pages` WHERE slug = ? LIMIT 1");
            $stmt->execute([$slug]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch (\PDOEXception $exception) {
            return false;
        }
    }

}


