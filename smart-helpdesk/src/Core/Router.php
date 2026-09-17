<?php
namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // สำหรับรันบน sub-folder ถ้ามี
        $path = str_replace('/public', '', $path);
        if ($path === '')
            $path = '/';

        if (isset($this->routes[$method][$path])) {
            $handler = $this->routes[$method][$path];
            $controller = new $handler[0]();
            $action = $handler[1];
            $controller->$action();
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}