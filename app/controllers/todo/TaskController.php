<?php

namespace App\controllers\todo;

use App\models\Check;
use App\models\todo\Category;
use App\models\todo\Tag;
use App\models\ToDo\Task;
use App\Services\Service;

class TaskController
{
    private Check $check;
    private Task $taskModel;
    private Tag $tagModel;
    private Category $categoryModel;

    public function __construct()
    {
        $userRole = $_SESSION['user_role'] ?? 0;
        $this->check = new Check($userRole);
        $this->taskModel = new Task();
        $this->tagModel = new Tag();
        $this->categoryModel = new Category;
    }

    public function index(): void
    {
        $this->check->requirePermission();
        $data = $this->taskModel->readAll($_SESSION);
        $data = $this->getDatum($data);
        Service::view('todo/tasks/index', $data);
    }

    public function completed(): void
    {
        $this->check->requirePermission();

        $data = $this->taskModel->readAllCompleted($_SESSION);
        foreach ($data as &$task) {
            $task['color'] = match ($task['priority']) {
                'low' => 'info',
                'medium' => 'success',
                'high' => 'warning',
                'urgent' => 'danger',
            };

        }
        Service::view('todo/tasks/completed', $data);
    }

    public function expired(): void
    {
        $this->check->requirePermission();

        $data = $this->taskModel->readAllExpired($_SESSION);
        foreach ($data as &$task) {
            $task['color'] = match ($task['priority']) {
                'low' => 'info',
                'medium' => 'success',
                'high' => 'warning',
                'urgent' => 'danger',
            };

        }
        Service::view('todo/tasks/expired', $data);
    }

    public function create(): void
    {
        $this->check->requirePermission();
        $categoryModel = new Category();
        $data = $categoryModel->findCategoriesWithUsability();
        Service::view('todo/tasks/create', $data);
    }

    public function store($data): void
    {

        if (isset($data['title']) && isset($data['finish_date']) && isset($data['user_id']) && isset($data['category_id'])) {
            if (empty($data['title'] || empty($data['finish_date']))) {
                echo "Title and description fields are required!";
                return;
            }

            $this->taskModel->store($data);
        }
        Service::redirect('/todo/tasks');
    }

    public function edit(int $id): void
    {
        $this->check->requirePermission();
        $categoryModel = new Category();
        $tagModel = new Tag();
        $data['task'] = $this->taskModel->edit($id);
        $data['status'] = $this->taskModel->status;
        $data['priority'] = $this->taskModel->priority;
        $data['categories'] = $categoryModel->findCategoriesWithUsability();
        $data['tags'] = $tagModel->getTagsByTaskId($id) != null ? $tagModel->getTagsByTaskId($id) : [];
        Service::view('todo/tasks/edit', $data);
    }


    public function update($data): void
    {
        tte($data);

        $data['title'] = trim($data['title']);
        $data['description'] = trim($data['description']);
        $interval = match ($data['reminder_at']) {
            '30_minutes' => new \DateInterval('PT30M'),
            '1_hour' => new \DateInterval('PT1H'),
            '2_hours' => new \DateInterval('PT2H'),
            '12_hours' => new \DateInterval('PT12H'),
            '24_hours' => new \DateInterval('PT1D'),
            '7_days' => new \DateInterval('PT7D'),
            default => new \DateInterval('PT3H'),
        };
        $data['finish_date'] = new \DateTime($data['finish_date']);
        $data['reminder_at'] = $data['finish_date']->sub($interval);
        $data['reminder_at'] = $data['reminder_at']->format('Y-m-d\TH:i');
        $data['finish_date'] = $data['finish_date']->format('Y-m-d\TH:i');

        $this->taskModel->update($data);


        // Обработка тегов
        $tags = explode(',', $data['tags']);
        $tags = array_map('trim', $tags);
        $oldTags = $this->tagModel->getTagsByTaskId($data['id']);
        // Удаляем старые связи между тегами и задачами
        $this->tagModel->removeAllTaskTag($data['id']);


        // Добавляем новые теги и связываем с задачами
        foreach ($tags as $title) {

            $tag = $this->tagModel->getTagByNameAndUserId($title, $data['user_id']);
            if ($tag === false) {
                $tag_id = ($this->tagModel->addTag($title, $data['user_id']))['id'];
            } else {
                $tag_id = $tag['id'];
            }
            $this->tagModel->addTaskTag($data['id'], $tag_id);

        }
        // Удаляем неиспользуемые теги
        foreach ($oldTags as $oldTag) {
            $this->tagModel->removeUnusedTag($oldTag['id']);
        }


        Service::redirect('/todo/tasks');
    }

    public function ByTag(int $id): void
    {
        $data['tag_id'] = $id;
        $data['user_id'] = $_SESSION['user_id'];
        $data = $this->taskModel->getTasksByTag($data);
        $data = $this->getDatum($data);
        $data[0]['tag'] = $this->tagModel->getTagTitleById($id);
        Service::view('/todo/tasks/byTag', $data);
    }

    public function delete($data): void
    {
        $this->taskModel->delete($data['id']);
        Service::redirect('/todo/tasks');
    }


    public function show($id): void
    {
        $data['id'] = $id;
        $data['user_id'] = $_SESSION['user_id'];
        $data = $this->taskModel->getTaskById($data);
        $data['task'] = $data;
        $data['category'] = $this->categoryModel->getCategoryById(['id' => $data['task']['category_id'], 'user_id' => $_SESSION['user_id']]);
        $data['tags'] = $this->tagModel->getTagsByTaskId($data['task']['id']);
        Service::view('todo/tasks/task', $data);
    }

    public function updateStatus($data): void
    {
        $data['user_id'] = $_SESSION['user_id'];
        $this->taskModel->updateStatusById($data);
        Service::redirect('/todo/tasks/show/' . $data['id']);
    }

    private function getDatum(array $data): array
    {
        foreach ($data as &$task) {
            $task['color'] = match ($task['priority']) {
                'low' => 'info',
                'medium' => 'success',
                'high' => 'warning',
                'urgent' => 'danger',
            };
            $categories = $this->categoryModel->readAll();
            foreach ($categories as $category) {
                $task['category'] = ($category['id'] == $task['category_id'] ? $category['title'] : ' ');
            }
            $task['tags'] = $this->tagModel->getTagsByTaskId($task['id']);

        }
        return $data;
    }
}