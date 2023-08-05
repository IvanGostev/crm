<?php


namespace App\controllers;

use App\models\Auth;
use App\Services\Service;

class AuthController
{


    public function register($data): void
    {
        if (isset($data['username']) && isset($data['email']) && isset($data['password']) && isset($data['confirm_password'])) {
            $data['username'] = trim($data['username']);
            $data['email'] = trim($data['email']);
            $data['password'] = trim($data['password']);
            $data['confirm_password'] = trim($data['confirm_password']);
            if (empty($data['username']) || empty($data['email']) || empty($data['password']) || empty($data['confirm_password'])) {
                echo 'All fields are required';
                return;
            }
            if ($data['password'] !== $data['confirm_password']) {
                echo "Passwords don't match";
                return;
            }
            $userModel = new Auth();
            if ($userModel->register($data)) {
                $user = $userModel->findByEmail($data['email']);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                Service::redirect('/');
            }
        } else {
            Service::redirect('/register');
        }
    }

    public function signup(): void
    {
        Service::view('auth/signup');
    }



    public function authenticate($data): void
    {
        $authModel = new Auth();
        if (isset($data['email']) && isset($data['password'])) {
            $data['email'] = trim($data['email']);
            $data['password'] = trim($data['password']);

            $user = $authModel->findByEmail($data['email']);
            if ($user && password_verify($data['password'], $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $authModel->updateLastLogin($user['id']);
                if ($data['remember'] == 'on') {
                    setcookie('user_email', $data['email'], time() + (7 * 24 * 60 * 60), '/');
                    setcookie('user_password', $data['password'], time() + (7 * 24 * 60 * 60), '/');
                }
                Service::redirect('/users');
            } else {
                echo "Invalid email or password";
            }
        }
    }

    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
        Service::redirect('/');
    }
}