<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\TicketController;

session_start();

$router = new Router();

// กำหนด Routes
$router->get('/', [TicketController::class, 'index']);
$router->post('/tickets/update-status', [TicketController::class, 'updateStatus']);

$router->dispatch();