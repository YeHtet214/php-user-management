<?php

use App\Controllers\UserController;
use App\Controllers\RoleController;

// User Routes
$router->get('/', [UserController::class, 'index']);

$router->get('/users', [UserController::class, 'index']);

$router->post('/users', [UserController::class, 'store']);

$router->post('/users/create', [UserController::class, 'create']);

$router->post('/users/update', [UserController::class, 'update']); 

$router->post('/users/delete', [UserController::class, 'destroy']);

// Role Routes
$router->get('/roles', [RoleController::class, 'index']);

$router->get('/roles/create', [RoleController::class, 'create']);

$router->post('/roles/create', [RoleController::class, 'create']);

$router->post('/roles/update', [RoleController::class, 'update']);

$router->post('/roles/delete', [RoleController::class, 'destory']);
