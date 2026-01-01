<?php

namespace App\Core;

class Request
{
    private $params = [];
    private $body = [];

    public function __construct()
    {
        $this->body = $this->getRequestBody();
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);
        return rtrim($uri, '/') ?: '/';
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getParam($key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function get($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function post($key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    public function input($key, $default = null)
    {
        return $this->body[$key] ?? $default;
    }

    public function all()
    {
        return array_merge($_GET, $_POST, $this->body);
    }

    private function getRequestBody()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        
        if (strpos($contentType, 'application/json') !== false) {
            $json = file_get_contents('php://input');
            return json_decode($json, true) ?? [];
        }

        return $_POST;
    }

    public function getHeaders()
    {
        return getallheaders();
    }

    public function getHeader($name, $default = null)
    {
        $headers = $this->getHeaders();
        $name = strtolower($name);
        
        foreach ($headers as $key => $value) {
            if (strtolower($key) === $name) {
                return $value;
            }
        }

        return $default;
    }
}

