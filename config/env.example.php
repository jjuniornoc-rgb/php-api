<?php
/**
 * Arquivo de exemplo de configuração
 * Copie este arquivo para config/env.php e configure suas variáveis
 */

return [
    'APP_NAME' => 'PHP_API',
    'APP_ENV' => 'development',
    'APP_DEBUG' => true,
    'APP_URL' => 'http://localhost',
    
    'DB_HOST' => 'localhost',
    'DB_PORT' => '3306',
    'DB_NAME' => 'api_db',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    
    'JWT_SECRET' => 'your-secret-key-here-change-in-production',
    'JWT_EXPIRATION' => 3600,
    
    'SERVER_PORT' => 8000
];

