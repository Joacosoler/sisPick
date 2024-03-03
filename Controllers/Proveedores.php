<?php
class Proveedores extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user,'proveedores');
        if (!empty($verificar) || $id_user == 1) {
            $data =$this->model->getProveedores();
            $data['categoria'] = $this->model->getCategorias();
        $this->views->getView($this, "index", $data);
        }else{
            header('Location: '.base_url. 'Errors/permisos');

        }
        if (empty($_SESSION['activo'])) {
            header("location: ". base_url);
        }
        
    }
    public function listar()
    {
        $data = $this->model->getProveedores();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarProv(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarProv(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarProv(' . $data[$i]['id'] . ');"><i class="fas fa-circle"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }



    public function registrar()
    {
        $cuil = $_POST['cuil'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $categoria = $_POST['categoria'];
        $id = $_POST['id'];

        if (empty($cuil) || empty($nombre) || empty($telefono)|| empty($direccion)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id == "") {
                    $data = $this->model->registrarProveedor($cuil, $nombre, $telefono, $direccion,$categoria);
                    if ($data == "ok") {
                        $msg = "si";
                    } else if ($data == "existe") {
                        $msg = "El Proveedor ya existe";
                    } else {
                        $msg = "Error al registrar el proveedor ";
                    }
                
            } else {
                $data = $this->model->modificarProveedor($cuil, $nombre, $telefono, $direccion,$categoria, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar el proveedor";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarProv($id);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionProv(0, $id);
        if ($data == 1){
            $msg = "ok";
        }else{

            $msg = "Error al eliminar usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionProv(1, $id);
        if ($data == 1){
            $msg = "ok";
        }else{

            $msg = "Error al reingresar usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    

}
?>
