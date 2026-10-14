<?php
require_once __DIR__ . '/../model/Sesion.php';
require_once __DIR__ . '/../model/ImagenUpload.php';
require_once __DIR__ . '/../model/JuegoDAO.php';
require_once __DIR__ . '/../model/ConsolaDAO.php';

class AdminJuegoController {
    private $juegoDAO;
    private $consolaDAO;

    public function __construct() {
        Sesion::requerirLogin();
        $this->juegoDAO = new JuegoDAO();
        $this->consolaDAO = new ConsolaDAO();
    }

    public function index() {
        $juegos = $this->juegoDAO->obtenerTodos();
        $flash = Sesion::tomarFlash();
        require __DIR__ . '/../view/admin_juegos.php';
    }

    public function nuevo() {
        $juego = null;
        $errores = [];
        $consolas = $this->consolaDAO->obtenerTodas();
        $datos = ['titulo' => '', 'precio' => '', 'replica' => '0', 'idConsola' => '', 'agotado' => false];
        require __DIR__ . '/../view/admin_juego_form.php';
    }

    public function editar($id = null) {
        $juego = $this->juegoDAO->obtenerPorId((int)$id);
        if ($juego === null) noEncontrado();
        $errores = [];
        $consolas = $this->consolaDAO->obtenerTodas();
        $datos = [
            'titulo'    => $juego->getTitulo(),
            'precio'    => $juego->getPrecio() ?? '',
            'replica'   => $juego->getReplica() ? '1' : '0',
            'idConsola' => $juego->getIdConsola(),
            'agotado'   => $juego->getAgotado(),
        ];
        require __DIR__ . '/../view/admin_juego_form.php';
    }

    public function guardar() {
        Sesion::verificarToken();
        $id = (int)($_POST['idJuego'] ?? 0);

        $juego = null;
        if ($id) {
            $juego = $this->juegoDAO->obtenerPorId($id);
            if ($juego === null) noEncontrado();
        }

        $datos = [
            'titulo'    => trim($_POST['titulo'] ?? ''),
            'precio'    => trim($_POST['precio'] ?? ''),
            'replica'   => ($_POST['replica'] ?? '0') === '1' ? '1' : '0',
            'idConsola' => $_POST['idConsola'] ?? '',
            'agotado'   => isset($_POST['agotado']),
        ];
        $errores = [];

        $lt = mb_strlen($datos['titulo']);
        if ($lt < 1 || $lt > 255) $errores['titulo'] = 'El título es obligatorio (hasta 255 caracteres).';

        $precio = null;
        if ($datos['precio'] !== '') {
            if (!is_numeric($datos['precio']) || $datos['precio'] < 0 || $datos['precio'] > 99999999) {
                $errores['precio'] = 'Precio inválido. Dejalo vacío para "Consultar precio".';
            } else {
                $precio = (float)$datos['precio'];
            }
        }

        $consolas = $this->consolaDAO->obtenerTodas();
        if (!is_scalar($datos['idConsola']) || $this->consolaDAO->obtenerPorId((int)$datos['idConsola']) === null)
            $errores['idConsola'] = 'Elegí una consola válida.';

        // La imagen se procesa al final, solo si lo demás está bien
        $nuevaImg = null;
        if (!$errores) {
            $errorImg = '';
            $nuevaImg = ImagenUpload::guardar($_FILES['imagen'] ?? null, $errorImg);
            if ($errorImg) $errores['imagen'] = $errorImg;
        }

        if ($errores) {
            require __DIR__ . '/../view/admin_juego_form.php';
            return;
        }

        $imagen = $nuevaImg ?? ($juego ? $juego->getImagen() : null);

        if ($juego) {
            $this->juegoDAO->actualizar($id, $datos['titulo'], $precio, $datos['replica'] === '1',
                (int)$datos['idConsola'], $imagen, $datos['agotado']);
            if ($nuevaImg) ImagenUpload::borrar($juego->getImagen());
            Sesion::flash('Juego actualizado.');
        } else {
            $this->juegoDAO->insertar($datos['titulo'], $precio, $datos['replica'] === '1',
                (int)$datos['idConsola'], $imagen, $datos['agotado']);
            Sesion::flash('Juego creado.');
        }
        redirigir('index.php?c=adminjuego');
    }

    public function eliminar() {
        Sesion::verificarToken();
        $id = (int)($_POST['idJuego'] ?? 0);
        $juego = $this->juegoDAO->obtenerPorId($id);
        if ($juego === null) redirigir('index.php?c=adminjuego');

        try {
            $this->juegoDAO->eliminar($id);
            ImagenUpload::borrar($juego->getImagen());
            Sesion::flash('Juego eliminado.');
        } catch (PDOException $e) {
            Sesion::flash('No se puede eliminar: tiene consultas asociadas. Marcalo como "Agotado" en su lugar.', 'error');
        }
        redirigir('index.php?c=adminjuego');
    }
}
