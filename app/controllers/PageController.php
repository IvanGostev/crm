<?php

namespace App\controllers;

use App\models\Page;
use App\models\Role;
use App\models\Check;
use App\Services\Service;

class PageController
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
        $pageModel = new Page();
        $pages = $pageModel->readAll();
        Service::view('pages/index', $pages);
    }

    public function create(): void
    {
        $this->check->requirePermission();
        $roleModel = new Role();
        $roles = $roleModel->readAll();
        Service::view('pages/create', $roles);
    }

    public function store($data): void
    {
        if (isset($data['title']) && isset($data['slug']) && isset($data['roles'])) {
            $data['title'] = trim($data['title']);
            $data['slug'] = trim($data['slug']);
            $data['roles'] = implode(',', $data['roles']);
            if (empty($data['title']) || empty($data['slug']) || empty($data['roles'])) {
                echo "Title, Slug and Role fields are required!";
                return;
            }
            $pageModel = new Page();
            $pageModel->store($data);
        }
        Service::redirect('/pages');
    }

    public function edit(int $id): void
    {
        $this->check->requirePermission();
        $pageModel = new Page();
        $roleModel = new Role();
        $page = $pageModel->edit($id);
        $roles = $roleModel->readAll();
        $data = null;
        $data['page'] = $page;
        $data['roles'] = $roles;
        Service::view('pages/edit', $data);
    }

    public function update(array $data): void
    {
        $pageModel = new Page();
        $data['roles'] = implode(",", $data['roles']);
        $pageModel->update($data['id'], $data);
        Service::redirect('/pages');
    }

    public function delete(array $data): void
    {
        $pageModel = new Page();
        $pageModel->delete($data['id']);
        Service::redirect('/pages');

    }

}