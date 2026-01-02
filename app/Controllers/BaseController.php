<?php

namespace App\Controllers;

use App\Core\Response;

class BaseController
{

    protected function success($data = null, $message = 'Sucesso', $statusCode = 200)
    {
        Response::success($data, $message, $statusCode);
    }

    protected function error($message = 'Erro', $statusCode = 400, $errors = null)
    {
        Response::error($message, $statusCode, $errors);
    }

    protected function notFound($message = 'Recurso não encontrado')
    {
        Response::notFound($message);
    }

    protected function validate($data, $rules)
    {
        $errors = [];

        foreach ($rules as $field => $rule) {
            $ruleArray = explode('|', $rule);
            $value = $data[$field] ?? null;

            foreach ($ruleArray as $singleRule) {
                if ($singleRule === 'required' && empty($value)) {
                    $errors[$field][] = "O campo {$field} é obrigatório";
                }

                if (strpos($singleRule, 'min:') === 0) {
                    $min = (int) substr($singleRule, 4);
                    if (strlen($value) < $min) {
                        $errors[$field][] = "O campo {$field} deve ter no mínimo {$min} caracteres";
                    }
                }

                if (strpos($singleRule, 'max:') === 0) {
                    $max = (int) substr($singleRule, 4);
                    if (strlen($value) > $max) {
                        $errors[$field][] = "O campo {$field} deve ter no máximo {$max} caracteres";
                    }
                }

                if ($singleRule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = "O campo {$field} deve ser um email válido";
                }
            }
        }

        if (!empty($errors)) {
            $this->error('Erro de validação', 422, $errors);
        }

        return true;
    }
}

