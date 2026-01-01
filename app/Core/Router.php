<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $middlewares = [];

    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function put($path, $handler)
    {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete($path, $handler)
    {
        $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch(Request $request)
    {
        $method = $request->getMethod();
        $uri = $request->getUri();

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchRoute($route['path'], $uri, $params)) {
                $request->setParams($params);
                $this->callHandler($route['handler'], $request);
                return;
            }
        }

        // Rota não encontrada
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Rota não encontrada'
        ]);
    }

    private function matchRoute($routePath, $uri, &$params)
    {
        $routePath = preg_replace('/\{([^}]+)\}/', '([^/]+)', $routePath);
        $routePath = '#^' . $routePath . '$#';

        if (preg_match($routePath, $uri, $matches)) {
            array_shift($matches);
            $params = $matches;
            return true;
        }

        return false;
    }

    private function callHandler($handler, Request $request)
    {
        if (is_string($handler) && strpos($handler, '@') !== false) {
            list($controller, $method) = explode('@', $handler);
            $controllerClass = "App\\Controllers\\{$controller}";
            
            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass();
                if (method_exists($controllerInstance, $method)) {
                    $controllerInstance->$method($request);
                    return;
                }
            }
        }

        if (is_callable($handler)) {
            call_user_func($handler, $request);
            return;
        }

        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao processar requisição'
        ]);
    }
}

