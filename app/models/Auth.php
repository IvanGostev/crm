<?php

namespace App\models;
use Database\Database;
class Auth
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

    public function register(array $data): bool
    {
        $created_at = date('Y-m-d H:i:s');
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        try {
            $stmt = $this->db->prepare("INSERT INTO `users` (username, email, password, created_at) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['username'], $data['email'], $data['password'], $created_at]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    /*    public function login(array $data): array|bool
        {
            try {
                $stmt = $this->db->prepare("SELECT * FROM `users` WHERE email = ? LIMIT 1");
                $stmt->execute($data['email']);
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);
                if ($user && password_verify($data['password'], $user['password'])) {
                    return $user;
                }
                return false;
            } catch (\PDOException $exception) {
                return false;
            }
        }*/

    public function findByEmail(string $email): array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $user ?? false;
        } catch (\PDOEXception $exception) {
            return false;
        }
    }
    public function updateLastLogin(int $id) : bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE `users` SET last_login = ? WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function findUserById(int $id) : array|bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
            $stmt->execute([$id]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $user ?? false;
        } catch (\PDOEXception $exception) {
            return false;
        }
    }

}