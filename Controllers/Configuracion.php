<?php
class Configuracion extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }
    public function index()
    {
        $data = $this->model->getEmpresa();
        $this->views->getView($this, "index", $data);
    }
    public function modificar()
    {
        $nombre = $_POST['nombre'];
        $cuit = $_POST['cuit'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $mensaje = $_POST['mensaje'];
        $id = $_POST['id'];
        $data =  $this->model->modificarDatos($nombre, $cuit, $telefono, $direccion, $mensaje, $id);
        if ($data == 'ok') {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        echo json_encode($msg);
        die();
    }
    public function reporteStock(){
        $data = $this->model->getStockMinimo();
        echo json_encode($data);
        die();

    }

}
?>