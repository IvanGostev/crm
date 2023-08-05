<?php

namespace App\controllers;

use App\Services\Service;
use App\models\Check;
use App\models\Role;
use App\models\User;


class UserController
{
    private Check $check;
    public function __construct() {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 0;
        $this->check = new Check($userRole);
    }
    public function index(): void
    {
        $this->check->requirePermission();
        $userModel = new User();
        $users = $userModel->readAll();
        Service::view('users/index', $users);
    }

    public function create(): void
    {
        $this->check->requirePermission();
        Service::view('users/create');
    }

    public function store($data): void
    {
        $this->check->requirePermission();
        if (isset($data['username']) && isset($data['email']) && isset($data['password']) && isset($data['confirm_password'])) {
            $pass = $data['password'];
            $pass_con = $data['confirm_password'];
            if ($pass !== $pass_con) {
                echo "Passwords don't match";
                return;
            }
            $userModel = new User();
            $userModel->store($data);
        }

        Service::redirect('/users');
    }

    public function edit(int $id): void
    {
        $this->check->requirePermission();
        $userModel = new User();
        $user = $userModel->edit($id);
        $roleModel = new Role();
        $roles = $roleModel->readAll();
        $data['user'] = $user;
        $data['roles'] = $roles;
        Service::view('/users/edit', $data);
    }

    public function update($data): void
    {
        $this->check->requirePermission();
        $userModel = new User();
        $userModel->update($data['id'], $data);
        Service::redirect('/users');
    }

    public function delete($data): void
    {
        $this->check->requirePermission();
        $userModel = new User();
        $userModel->delete($data['id']);
        Service::redirect('/users');
    }
}