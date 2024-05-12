<?php

namespace Alvaro\TodoPhp\config;

class Router
{

    private $routes = [];

    public function addRoute($controller)
    {
        $this->routes[] = $controller;
    }

    public function dispatch(string $controller, string $httpMethod, string|int $id = null, array $data = null)
    {
        if (!in_array($controller, $this->routes)) {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Rota inexistente',
            ]);
            die;
        }

        $controller = ucfirst($controller) . 'Controller';

        if (!isset($id)) {
            $action = match ($httpMethod) {
                'GET' => 'index',
                'POST' => 'create',
                default => null
            };

        } else {
            $action = match ($httpMethod) {
                'GET' => 'show',
                'PUT', 'PATCH' => 'update',
                'DELETE' => 'delete',
                default => null
            };
        }

        if (!isset($action)) {
            http_response_code(400);
            echo json_encode([
                'error' => 'ID do recurso não fornecido. Por favor, forneça um ID válido na URL.'
            ]);
            die;
        }

        $controllerNamespace = 'Alvaro\\TodoPhp\\controllers';
        $controllerInstance = new ($controllerNamespace . '\\' . $controller);

        if ($action == 'create') {
            $controllerInstance->$action($data);
            die;
        }

        $controllerInstance->$action($id, $data);
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
