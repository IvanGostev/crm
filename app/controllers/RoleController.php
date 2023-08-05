<?php

namespace App\controllers;

use App\models\Check;
use App\models\Role;
use App\Services\Service;

class RoleController
{
    private Check $check;
    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 0;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
        $this->check->requirePermission();
        $roleModel = new Role();
        $roles = $roleModel->readAll();
        Service::view('/roles/index', $roles);
    }

    public function create(): void
    {
        $this->check->requirePermission();
        Service::view('/roles/create');
    }

    public function store($data): void
    {
        $this->check->requirePermission();
        if (isset($data['name']) && isset($data['description'])) {
            if (empty($data['name'] || empty($data['description']))) {
                echo "Name and description fields are required!";
                return;
            }
            $roleModel = new Role();
            $roleModel->store($data);
        }
        Service::redirect('/roles');
    }

    public function edit($data): void
    {
        $this->check->requirePermission();
        $roleModel = new Role();
        $data = $roleModel->edit($data['id']);
        Service::view('/roles/index', $data);
    }

    public function update($data): void
    {
        $this->check->requirePermission();
        $roleModel = new Role();
        $roleModel->update($data['id'], $data);
        Service::redirect('/roles');
    }

    public function delete($data): void
    {
        $this->check->requirePermission();
        $roleModel = new Role();
        $roleModel->delete($data['id']);
        Service::redirect('/roles');
    }
}