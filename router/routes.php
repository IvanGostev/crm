<?php
use App\Services\Router;
use App\controllers\MainController;
use App\controllers\PageController;
use App\controllers\AuthController;
use App\controllers\UserController;
use App\controllers\RoleController;
use App\controllers\todo\CategoryController;
use App\controllers\todo\TaskController;

// Main
Router::get('/', MainController::class, 'index');

// Auth
Router::get('/signup',AuthController::class, 'signup');
Router::post('/register',AuthController::class , 'register');
Router::post('/authenticate', AuthController::class, 'authenticate');
Router::post('/logout', AuthController::class, 'logout');

// Users
Router::get('/users', UserController::class, 'index');
Router::get('/users/create', UserController::class, 'create');
Router::post('/users/store', UserController::class, 'store');
Router::get('/users/edit', UserController::class, 'edit');
Router::post('/users/update', UserController::class, 'update');
Router::post('/users/delete', UserController::class, 'delete');

// Roles
Router::get('/roles', RoleController::class, 'index');
Router::get('/roles/create', RoleController::class, 'create');
Router::post('/roles/store', RoleController::class, 'store');
Router::get('/roles/edit', RoleController::class, 'edit');
Router::post('/roles/update', RoleController::class, 'update');
Router::post('/roles/delete', RoleController::class, 'delete');

// Pages
Router::get('/pages', PageController::class, 'index');
Router::get('/pages/create', PageController::class, 'create');
Router::post('/pages/store', PageController::class, 'store');
Router::get('/pages/edit', PageController::class, 'edit');
Router::post('/pages/update', PageController::class, 'update');
Router::post('/pages/delete', PageController::class, 'delete');

// ---ToDo---

//  Categories

Router::get('/todo/categories', CategoryController::class, 'index');
Router::get('/todo/categories/create', CategoryController::class, 'create');
Router::post('/todo/categories/store', CategoryController::class, 'store');
Router::get('/todo/categories/edit', CategoryController::class, 'edit');
Router::post('/todo/categories/update', CategoryController::class, 'update');
Router::post('/todo/categories/delete', CategoryController::class, 'delete');

// Tasks

Router::get('/todo/tasks', TaskController::class, 'index');
Router::get('/todo/tasks/completed', TaskController::class, 'completed');
Router::get('/todo/tasks/expired', TaskController::class, 'expired');
Router::get('/todo/tasks/create', TaskController::class, 'create');
Router::post('/todo/tasks/store', TaskController::class, 'store');
Router::get('/todo/tasks/edit', TaskController::class, 'edit');
Router::post('/todo/tasks/update', TaskController::class, 'update');
Router::post('/todo/tasks/delete', TaskController::class, 'delete');
Router::get('/todo/tasks/by-tag', TaskController::class,'ByTag');
Router::get('/todo/tasks/show', TaskController::class, 'show');
Router::post('/todo/tasks/update-status', TaskController::class, 'updateStatus');

Router::enable();