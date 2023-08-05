<?php

namespace App\controllers;

use App\models\todo\Task;
use App\Services\Service;


class MainController
{
    private Task $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }
    public function index(): void
    {
        if (isset($_SESSION['user_id']) || !ENABLE_PERMISSION_CHECK) {
            $data = $this->taskModel->readAll($_SESSION);
            Service::view('todo/tasks/calendar', $data);
        } else {
            Service::view('main/index');
        }
    }
}