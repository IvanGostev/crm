<?php

namespace App\Services;

use Composer\Autoload\ClassLoader;

class Router
{
    private static array $list = [];

    public static function view($uri, $page): void
    {
        self::$list[] = [
            'uri' => $uri,
            'page' => $page
        ];

    }

    public static function get(string $uri, mixed $class, string $method,): void
    {
        self::$list[] = [
            'uri' => $uri,
            'class' => $class,
            'method' => $method,
            'key' => 'get'
        ];
    }

    public static function post(string $uri, $class, string $method, bool $files = false): void
    {
        self::$list[] = [
            'uri' => $uri,
            'class' => $class,
            'method' => $method,
            'files' => $files,
            'key' => 'post'
        ];
    }

    public static function redirect(string $uri): void
    {
        header('Location: ' . $uri);
    }

    public static function enable(): void
    {
        $query = $_GET['query'];
        $arr = explode('/', $query);
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
        $query = implode('/', $arr);
        foreach (self::$list as $route) {
            if ($route['uri'] === '/' . $query) {
                $action = new $route['class'];
                $method = $route['method'];
                if ($route['key'] === 'post') {
                    if (isset($route['files'])) {
                        $action->$method($_POST, $_FILES);
                    } else {
                        $action->$method($_POST);
                    }
                }
                if ($route['key'] === 'get') {
                    if ($id !== null) {
                        $action->$method($id);
                    } else {
                        $action->$method();
                    }
                }
                die();
            }
        }
        self::error(404);
    }

    private static function error(int $error): void
    {
        $error = str_split($error);
        require_once 'views/errors/error.php';
    }
}