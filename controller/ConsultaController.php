<?php
require_once __DIR__ . '/../model/JuegoDAO.php';
require_once __DIR__ . '/../model/ConsultaDAO.php';

// Consulta de precio de un juego
class ConsultaController {
    private $juegoDAO;
    private $consultaDAO;

    public function __construct() {
        $this->juegoDAO = new JuegoDAO();
        $this->consultaDAO = new ConsultaDAO();
    }

    // Muestra el formulario
    public function formulario($id = null) {
        $juego = $this->juegoDAO->obtenerPorId((int)$id);
        if ($juego === null) noEncontrado();

        $errores = [];
        $datos = ['nombre' => '', 'email' => '', 'telefono' => '', 'contacto' => 'email', 'mensaje' => '', 'acepta' => false];
        require __DIR__ . '/../view/consulta_form.php';
    }

    // Procesa el formulario (POST)
    public function enviar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirigir('index.php');

        $juego = $this->juegoDAO->obtenerPorId((int)($_POST['idJuego'] ?? 0));
        if ($juego === null) noEncontrado();

        // Campo trampa para bots: un usuario real nunca lo completa
        if (trim($_POST['sitio_web'] ?? '') !== '') redirigir('index.php?c=consulta&a=gracias');

        $datos = [
            'nombre'   => trim($_POST['nombre'] ?? ''),
            'email'    => trim($_POST['email'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'contacto' => $_POST['contacto'] ?? 'email',
            'mensaje'  => trim($_POST['mensaje'] ?? ''),
            'acepta'   => isset($_POST['acepta']),
        ];
        $errores = [];

        $len = mb_strlen($datos['nombre']);
        if ($len < 2 || $len > 100) $errores['nombre'] = 'Ingresá tu nombre (2 a 100 caracteres).';
        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($datos['email']) > 100)
            $errores['email'] = 'Ingresá un email válido.';
        if ($datos['telefono'] !== '' && !preg_match('/^[0-9+\-\s]{6,20}$/', $datos['telefono']))
            $errores['telefono'] = 'El teléfono solo admite números, +, - y espacios (6 a 20).';
        if (!in_array($datos['contacto'], ['email', 'telefono', 'whatsapp'], true))
            $errores['contacto'] = 'Elegí una opción válida.';
        elseif ($datos['contacto'] !== 'email' && $datos['telefono'] === '' && !isset($errores['telefono']))
            $errores['telefono'] = 'Cargá un teléfono para contactarte por esa vía.';
        $lm = mb_strlen($datos['mensaje']);
        if ($lm < 10 || $lm > 1000) $errores['mensaje'] = 'El mensaje debe tener entre 10 y 1000 caracteres.';
        if (!$datos['acepta']) $errores['acepta'] = 'Tenés que aceptar que te contactemos.';

        if ($errores) {
            require __DIR__ . '/../view/consulta_form.php';
            return;
        }

        // La preferencia de contacto se guarda dentro del mensaje
        $msg = "[Prefiere contacto por: {$datos['contacto']}]\n" . $datos['mensaje'];
        $this->consultaDAO->insertar($datos['nombre'], $datos['email'], $datos['telefono'], $msg, $juego->getIdJuego());

        redirigir('index.php?c=consulta&a=gracias');   // Post/Redirect/Get: evita reenvíos al recargar
    }

    public function gracias() {
        require __DIR__ . '/../view/consulta_ok.php';
    }
}
