<?php
require_once __DIR__ . '/../model/Sesion.php';
require_once __DIR__ . '/../model/UsuarioDAO.php';

class AuthController {
    const MAX_INTENTOS = 5;
    const BLOQUEO_SEGUNDOS = 60;

    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    // Muestra el formulario de login
    public function login() {
        if (isset($_SESSION['idUsuario'])) redirigir('index.php?c=admin');
        $flash = Sesion::tomarFlash();
        require __DIR__ . '/../view/login.php';
    }

    // Procesa el login (POST)
    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirigir('index.php?c=auth&a=login');

        if (!Sesion::tokenValido()) {
            Sesion::flash('Sesión vencida, intentá de nuevo.', 'error');
            redirigir('index.php?c=auth&a=login');
        }

        if (($_SESSION['bloqueo_hasta'] ?? 0) > time()) {
            Sesion::flash('Demasiados intentos fallidos. Esperá un minuto y probá de nuevo.', 'error');
            redirigir('index.php?c=auth&a=login');
        }

        $usuario = trim($_POST['usuario'] ?? '');
        $clave = $_POST['clave'] ?? '';
        if (!is_string($clave)) $clave = '';

        $fila = $this->usuarioDAO->buscarPorUsuario($usuario);

        // Si el usuario no existe se compara igual contra un hash falso,
        // para que tarde lo mismo y no revele qué usuarios existen
        $hash = $fila['passwordHash'] ?? password_hash('relleno', PASSWORD_DEFAULT);
        $ok = password_verify($clave, $hash) && $fila !== null;

        if (!$ok) {
            $_SESSION['intentos'] = ($_SESSION['intentos'] ?? 0) + 1;
            if ($_SESSION['intentos'] >= self::MAX_INTENTOS) {
                $_SESSION['bloqueo_hasta'] = time() + self::BLOQUEO_SEGUNDOS;
                $_SESSION['intentos'] = 0;
            }
            Sesion::flash('Usuario o contraseña incorrectos.', 'error');
            redirigir('index.php?c=auth&a=login');
        }

        session_regenerate_id(true);   // evita fijación de sesión
        unset($_SESSION['intentos'], $_SESSION['bloqueo_hasta'], $_SESSION['csrf']);
        $_SESSION['idUsuario'] = $fila['idUsuario'];
        $_SESSION['usuario'] = $fila['usuario'];

        redirigir('index.php?c=admin');
    }

    public function logout() {
        Sesion::verificarToken();
        $_SESSION = [];
        session_destroy();
        redirigir('index.php');
    }
}
