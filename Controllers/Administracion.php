<?php
class Administracion extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: ". base_url);
        }
        parent::__construct();
    }

    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user,'configuracion');
        print_r($verificar);
        exit;
    }
    public function home()
    {
        $data['usuarios'] =$this->model->getDatos('usuarios');
        $data ['clientes'] =$this->model->getDatos('clientes');
        $data ['productos'] =$this->model->getDatos('productos');
        $data ['categorias'] =$this->model->getDatos('categorias');
        $data ['medidas'] =$this->model->getDatos('medidas');
        $data ['proveedores'] =$this->model->getDatos('proveedores');
        $data ['compras'] =$this->model->getDatos('compras');
        $data ['ventas'] =$this->model->getDatos('ventas');

        $this->views->getView($this, "home", $data);

    }
    public function reporteStock(){
        $data = $this->model->getStockMinimo();
        echo json_encode($data);
        die();

    }
    
    public function productosVendidos(){
        $data = $this->model->getproductosVendidos();
        echo json_encode($data);
        die();

    }
}
