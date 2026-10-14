<?php
// Utilidades de sesión: guardia de login, token CSRF y mensajes flash
class Sesion {
    public static function requerirLogin() {
        if (!isset($_SESSION['idUsuario'])) {
            redirigir('index.php?c=auth&a=login');
        }
    }

    public static function token() {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf'];
    }

    public static function tokenValido() {
        return $_SERVER['REQUEST_METHOD'] === 'POST'
            && hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '');
    }

    // Corta la ejecución si la petición no es un POST con token válido
    public static function verificarToken() {
        if (!self::tokenValido()) {
            http_response_code(400);
            exit('Solicitud inválida');
        }
    }

    public static function flash($msg, $tipo = 'ok') {
        $_SESSION['flash'] = ['msg' => $msg, 'tipo' => $tipo];
    }

    public static function tomarFlash() {
        $f = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        return $f;
    }
}
