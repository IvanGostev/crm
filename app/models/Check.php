<?php
namespace App\models;
use App\models\Page;
use App\Services\Service;

class Check
{
    private int $userRole;

    public function __construct(int $d)
    {
        $this->userRole = $d;
    }
    private function getCurrentUrlSlug(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $pathWithoutBase = str_replace(Domain, "", $url);
        return trim($pathWithoutBase, '/');
        // Упрощенная система по началу
//        $segments = explode('/',ltrim($pathWithoutBase, '/') );
//        return $segments[0];
    }

    private function checkPermission($slug): bool
    {
        $pageModel = new Page();

        $arr = explode('/', $slug);
        // Удаляем '/' с конца
        if ($arr[count($arr) - 1] == null) {
            unset($arr[count($arr) - 1]);
        }
        // Находим id, и удаляем его из массива
        $id = null;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] === 'edit' || $arr[$i] === 'by-tag' || $arr[$i] === 'show') {
                $id = $arr[$i + 1];
                unset($arr[$i + 1]);
                break;
            }
        }
        $slug = implode('/', $arr);



        $page = $pageModel->findBySlug($slug);
        if (!$page) {
            return false;
        }
        $allowedRoles = explode(',', $page['roles']);
        if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], $allowedRoles)) {
            return true;
        } else {
            return false;
        }
    }

    public function requirePermission() : void {
        if (!ENABLE_PERMISSION_CHECK) {
            return;
        }
        $slug = $this->getCurrentUrlSlug();
        if (!$this->checkPermission($slug)) {
            Service::redirect('/');
            exit();
        }
    }
}
