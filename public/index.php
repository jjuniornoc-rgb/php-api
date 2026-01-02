<?php

// Tratamento de erros básico
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Core\Request;
use Dotenv\Dotenv;

// Carregar variáveis de ambiente (opcional)
if (file_exists(__DIR__ . '/../.env')) {
    try {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
    } catch (Exception $e) {
        // Ignorar erros de .env em produção
    }
}

// Headers CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json; charset=UTF-8');

// Tratar requisições OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Criar instância do Router
$router = new Router();

// Carregar e registrar rotas
$routes = require_once __DIR__ . '/../routes/api.php';
$routes($router);

// Processar requisição
$request = new Request();
$router->dispatch($request);

