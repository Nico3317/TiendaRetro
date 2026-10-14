<?php
require_once __DIR__ . '/../model/Sesion.php';
require_once __DIR__ . '/../model/ConsolaDAO.php';

class AdminConsolaController {
    private $dao;

    public function __construct() {
        Sesion::requerirLogin();
        $this->dao = new ConsolaDAO();
    }

    public function index() {
        $consolas = $this->dao->obtenerTodas();
        $cantidades = $this->dao->cantidadesDeJuegos();
        $flash = Sesion::tomarFlash();
        require __DIR__ . '/../view/admin_consolas.php';
    }

    public function nueva() {
        $consola = null;
        $errores = [];
        $datos = ['nombre' => '', 'fabricante' => ''];
        require __DIR__ . '/../view/admin_consola_form.php';
    }

    public function editar($id = null) {
        $consola = $this->dao->obtenerPorId((int)$id);
        if ($consola === null) noEncontrado();
        $errores = [];
        $datos = ['nombre' => $consola->getNombre(), 'fabricante' => $consola->getFabricante() ?? ''];
        require __DIR__ . '/../view/admin_consola_form.php';
    }

    public function guardar() {
        Sesion::verificarToken();
        $id = (int)($_POST['idConsola'] ?? 0);
        $consola = null;
        if ($id) {
            $consola = $this->dao->obtenerPorId($id);
            if ($consola === null) noEncontrado();
        }

        $datos = [
            'nombre'     => trim($_POST['nombre'] ?? ''),
            'fabricante' => trim($_POST['fabricante'] ?? ''),
        ];
        $errores = [];

        $ln = mb_strlen($datos['nombre']);
        if ($ln < 1 || $ln > 55) $errores['nombre'] = 'El nombre es obligatorio (hasta 55 caracteres).';
        if (mb_strlen($datos['fabricante']) > 55) $errores['fabricante'] = 'Máximo 55 caracteres.';

        if ($errores) {
            require __DIR__ . '/../view/admin_consola_form.php';
            return;
        }

        if ($consola) {
            $this->dao->actualizar($id, $datos['nombre'], $datos['fabricante']);
            Sesion::flash('Consola actualizada.');
        } else {
            $this->dao->insertar($datos['nombre'], $datos['fabricante']);
            Sesion::flash('Consola creada.');
        }
        redirigir('index.php?c=adminconsola');
    }

    public function eliminar() {
        Sesion::verificarToken();
        try {
            $this->dao->eliminar((int)($_POST['idConsola'] ?? 0));
            Sesion::flash('Consola eliminada.');
        } catch (PDOException $e) {
            Sesion::flash('No se puede eliminar: la consola tiene juegos cargados. Borrá o movés esos juegos primero.', 'error');
        }
        redirigir('index.php?c=adminconsola');
    }
}
