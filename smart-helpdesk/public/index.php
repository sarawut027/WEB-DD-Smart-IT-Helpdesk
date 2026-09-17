<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\TicketController;

session_start();

$router = new Router();

// กำหนด Routes
$router->get('/', [TicketController::class, 'index']);
$router->post('/tickets/update-status', [TicketController::class, 'updateStatus']);

$router->dispatch();