<?php
namespace App\Services;

use App\models\Auth;

class Service {
   public static function view(string $view, array $data = null) : void
    {
        require_once 'views/pages/' . $view . '.php';
    }
    public static function redirect(string $uri): void
    {
        header('Location: ' . $uri);
    }
    public static function is_active(string $path) : string
    {
        return $path === $_SERVER['REQUEST_URI'] ? 'active' : ' ';
    }
    public static function findUserById($id) : array|bool
    {
        return (new Auth())->findUserById($id) ?? false;
    }

}
