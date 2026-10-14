<?php
require_once __DIR__ . '/../config/config.php';

class Conexion {
    private static $pdo = null;

    public static function getConexion() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
            } catch (PDOException $e) {
                error_log('Conexion BD: ' . $e->getMessage());
                http_response_code(500);
                exit('No se pudo conectar con la base de datos. Verificá que MySQL esté iniciado y que los datos de config/config.php sean correctos.');
            }
        }
        return self::$pdo;
    }
}
