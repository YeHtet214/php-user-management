<?php

use App\Controllers\UserController;

$router->get('/', [UserController::class, 'index']);

$router->get('/users', [UserController::class, 'index']);

$router->post('/users', [UserController::class, 'store']);

$router->post('/users/create', [UserController::class, 'create']);

$router->post('/users/update', [UserController::class, 'update']); 

$router->post('/users/delete', [UserController::class, 'destroy']);