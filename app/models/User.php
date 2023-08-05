<?php

namespace App\models;
use Database\Database;
class User
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT * FROM `users`");
        } catch (\PDOException $exception) {
            $this->createTables();
        }
    }

    private function createTables(): void
    {
        if ($this->createTableRoles()) {
            $this->createTableUsers();
        }
        if (!$this->rolesExist()) {
            $insertRolesQuery = "INSERT INTO `roles` (`role_name`, `role_description`) VALUES
                ('Subscriber', 'Может только читать статьи и оставлять комментарии, но не имеет права создавать свой контент или управлять сайтом.'),
                ('Editor', 'Доступ к управлению и публикации статей, страниц и других контентных материалов на сайте. Редактор также может управлять комментариями и разрешать или запрещать их публикацию.'),
                ('Author', 'Может создавать и публиковать собственные статьи, но не имеет возможности управлять контентом других пользователей.'),
                ('Contributor', 'Может создавать свои собственные статьи, но они не могут быть опубликованы до одобрения администратором или редактором.'),
                ('Administrator', 'Полный доступ ко всем функциям сайта, включая управление пользователями, плагинами а также создание и публикация статей.');";
            $this->db->exec($insertRolesQuery);
        }

        // Вставка записи в таблицу users
        if (!$this->adminUserExists()) {
            $insertAdminQuery = "INSERT INTO `users` (`username`, `email`, `password`, `is_admin`, `role`) VALUES
                ('Admin', 'admin@gmail.com', '\$2y\$10\$dySccJEuCWDzywOgSoSU.eafBWHBXWp0/Nd7gohVz1z6mw1QzbEjW', 1, (SELECT `id` FROM `roles` WHERE `role_name` = 'Administrator'));";
            $this->db->exec($insertAdminQuery);
        }
    }

    private function createTableUsers(): bool
    {
        try {
            $stmt = $this->db->prepare("CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
    `password` VARCHAR(255) NOT NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
    `role` int(11) NOT NULL DEFAULT 1,                      
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `last_login` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`role`) REFERENCES `roles`(`id`)
      )");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    private function createTableRoles(): bool
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

    public function readAll(): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users`");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function store(array $data): bool
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $created_at = date('Y-m-d H:i:s');
        try {
            $stmt = $this->db->prepare("INSERT INTO `users` (username, email, password, created_at) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['username'], $data['email'], $data['password'], $created_at]);
            return true;
        } catch (\PDOException $exception) {
            var_dump($data);
            return false;
        }
    }


    public function edit(int $id): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, role = ?, email = ? WHERE id = ?");
            $stmt->execute([$data['username'], $data['role'], $data['email'], $id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `users` WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }


}