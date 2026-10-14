<?php
require_once __DIR__ . '/../model/ConsolaDAO.php';
require_once __DIR__ . '/../model/MensajeDAO.php';

// Formulario de contacto general
class ContactoController {
    const MOTIVOS = [
        'general'  => 'Consulta general',
        'comprar'  => 'Quiero comprar',
        'vender'   => 'Quiero vender o permutar mis juegos',
        'busqueda' => 'Busco un juego que no está en el catálogo',
        'otro'     => 'Otro motivo',
    ];
    const PREFERENCIAS = ['email' => 'Email', 'telefono' => 'Llamada', 'whatsapp' => 'WhatsApp'];

    private $consolaDAO;
    private $mensajeDAO;

    public function __construct() {
        $this->consolaDAO = new ConsolaDAO();
        $this->mensajeDAO = new MensajeDAO();
    }

    public function formulario() {
        $consolas = $this->consolaDAO->obtenerTodas();
        $errores = [];
        $datos = [
            'nombre' => '', 'email' => '', 'telefono' => '', 'motivo' => '',
            'consolas' => [], 'preferencia' => 'email', 'mensaje' => '', 'acepta' => false,
        ];
        require __DIR__ . '/../view/contacto.php';
    }

    public function enviar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirigir('index.php?c=contacto&a=formulario');

        // Campo trampa para bots
        if (trim($_POST['sitio_web'] ?? '') !== '') redirigir('index.php?c=contacto&a=gracias');

        $consolas = $this->consolaDAO->obtenerTodas();
        $nombresConsolas = [];
        foreach ($consolas as $c) $nombresConsolas[$c->getIdConsola()] = $c->getNombre();

        $marcadas = $_POST['consolas'] ?? [];
        $marcadas = is_array($marcadas) ? array_map('intval', $marcadas) : [];

        $datos = [
            'nombre'      => trim($_POST['nombre'] ?? ''),
            'email'       => trim($_POST['email'] ?? ''),
            'telefono'    => trim($_POST['telefono'] ?? ''),
            'motivo'      => $_POST['motivo'] ?? '',
            'consolas'    => $marcadas,
            'preferencia' => $_POST['preferencia'] ?? 'email',
            'mensaje'     => trim($_POST['mensaje'] ?? ''),
            'acepta'      => isset($_POST['acepta']),
        ];
        if (!is_string($datos['motivo'])) $datos['motivo'] = '';
        if (!is_string($datos['preferencia'])) $datos['preferencia'] = '';
        $errores = [];

        $len = mb_strlen($datos['nombre']);
        if ($len < 2 || $len > 100) $errores['nombre'] = 'Ingresá tu nombre (2 a 100 caracteres).';
        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($datos['email']) > 100)
            $errores['email'] = 'Ingresá un email válido.';
        if ($datos['telefono'] !== '' && !preg_match('/^[0-9+\-\s]{6,20}$/', $datos['telefono']))
            $errores['telefono'] = 'El teléfono solo admite números, +, - y espacios (6 a 20).';
        if (!isset(self::MOTIVOS[$datos['motivo']])) $errores['motivo'] = 'Elegí el motivo de tu consulta.';
        foreach ($marcadas as $idc) {
            if (!isset($nombresConsolas[$idc])) { $errores['consolas'] = 'Alguna consola elegida no es válida.'; break; }
        }
        if (!isset(self::PREFERENCIAS[$datos['preferencia']]))
            $errores['preferencia'] = 'Elegí una opción válida.';
        elseif ($datos['preferencia'] !== 'email' && $datos['telefono'] === '' && !isset($errores['telefono']))
            $errores['telefono'] = 'Cargá un teléfono para contactarte por esa vía.';
        $lm = mb_strlen($datos['mensaje']);
        if ($lm < 10 || $lm > 1000) $errores['mensaje'] = 'El mensaje debe tener entre 10 y 1000 caracteres.';
        if (!$datos['acepta']) $errores['acepta'] = 'Tenés que aceptar que te contactemos.';

        if ($errores) {
            require __DIR__ . '/../view/contacto.php';
            return;
        }

        $interes = implode(', ', array_map(function ($idc) use ($nombresConsolas) {
            return $nombresConsolas[$idc];
        }, array_unique($marcadas)));

        $this->mensajeDAO->insertar(
            $datos['nombre'], $datos['email'], $datos['telefono'],
            self::MOTIVOS[$datos['motivo']], $interes, $datos['preferencia'], $datos['mensaje']
        );

        redirigir('index.php?c=contacto&a=gracias');
    }

    public function gracias() {
        require __DIR__ . '/../view/contacto_ok.php';
    }
}
