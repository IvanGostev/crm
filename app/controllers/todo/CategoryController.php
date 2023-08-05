<?php

namespace App\controllers\todo;

use App\models\Check;
use App\models\ToDo\Category;
use App\Services\Service;

class CategoryController
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
        $categoryModel = new Category();
        $categories = $categoryModel->readAll();
        Service::view('todo/categories/index', $categories);
    }

    public function create(): void
    {
        $this->check->requirePermission();
        Service::view('todo/categories/create');
    }

    public function store($data): void
    {
        if (isset($data['title']) && isset($data['description'])) {
            if (empty($data['title'] || empty($data['description']))) {
                echo "Name and description fields are required!";
                return;
            }
            $categoryModel = new Category();
            $categoryModel->store($data);
        }
        Service::redirect('/todo/categories');
    }

    public function edit(int $id): void
    {
        $this->check->requirePermission();
        $categoryModel = new Category();
        $data = $categoryModel->edit($id);
        Service::view('todo/categories/edit', $data);
    }

    public function update($data): void
    {
        $categoryModel = new Category();
        $data['usability'] = isset($data['usability']) ? 1 : 0;
        $categoryModel->update($data);
        Service::redirect('/todo/categories');
    }

    public function delete($data): void
    {
        $categoryModel = new Category();
        $categoryModel->delete($data['id']);
        Service::redirect('/todo/categories');
    }
}