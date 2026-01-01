<?php

namespace App\Core;

class Response
{
    public static function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit();
    }

    public static function success($data = null, $message = 'Sucesso', $statusCode = 200)
    {
        self::json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public static function error($message = 'Erro', $statusCode = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        self::json($response, $statusCode);
    }

    public static function notFound($message = 'Recurso não encontrado')
    {
        self::error($message, 404);
    }

    public static function unauthorized($message = 'Não autorizado')
    {
        self::error($message, 401);
    }

    public static function forbidden($message = 'Acesso negado')
    {
        self::error($message, 403);
    }

    public static function validationError($errors, $message = 'Erro de validação')
    {
        self::error($message, 422, $errors);
    }
}

