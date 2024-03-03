<?php
class Compras extends Controller
{

    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user,'compras');
        if (!empty($verificar) || $id_user == 1) {
           //$data =$this->model->getCompras();
            $data['proveedores'] = $this->model->getProveedores();
        $this->views->getView($this, "index", $data);
        }else{
            header('Location: '.base_url. 'Errors/permisos');

        }
        if (empty($_SESSION['activo'])) {
            header("location: ". base_url);
        }
        
    }
    public function precios()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user,'compras');
        if (!empty($verificar) || $id_user == 1) {
           //$data =$this->model->getCompras();
            $data['proveedores'] = $this->model->getProveedores();
        $this->views->getView($this, "precios", $data);
        }else{
            header('Location: '.base_url. 'Errors/permisos');

        }
        if (empty($_SESSION['activo'])) {
            header("location: ". base_url);
        }
        
    }
    //public function index()
    //{
      //  $this->views->getView($this, "index");
        //$data['proveedores'] = $this->model->getProveedores();
    //}

    public function buscarCodigo($cod)
    {
        $data = $this->model->getProCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresar()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_compra'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalle($id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = "ok";
            } else {
                $msg = "error al ingresar el producto";
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle($precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "error al modificar el producto";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {

        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($id_usuario);
        $data['total_pagar'] = $this->model->calcularCompra($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function delete($id)
    {

        $data = $this->model->deleteDetalle($id);
        if ($data == 'ok') {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        echo json_encode($msg);
        die();
    }
    public function registrarCompra()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularCompra($id_usuario);
        $data = $this->model->registrarCompra($total['total']);
        if ($data == 'ok') {
            $detalle = $this->model->getDetalle($id_usuario);
            $id_compra = $this->model->id_compra();
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $id_pro = $row['id_producto'];
                $sub_total = $cantidad * $precio;

                $this->model->registrarDetalleCompra($id_compra['id'], $id_pro, $cantidad, $precio, $sub_total);
            }
            $vaciar = $this->model->vaciarDetalle($id_usuario);
            if ($vaciar == 'ok') {
                $msg = array('msg' => 'ok','id_compra' => $id_compra['id']);
            }
        } else {
            $msg = 'error a realizar la orden de compra';
        }
        echo json_encode($msg);
        die();
    }

    public function generarPdf($id_compra)

    {

        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProCompra($id_compra);

        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Orden de compra');
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->Cell(60, 10, 'Orden de compra',0,1,'C');
        $pdf->Image(base_url . 'Assets/img/ico.png', 180, 5, 25, 25);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(19, 5, 'Nombre: ', 0, 0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(20, 5, $empresa['nombre'], 0, 1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(10, 5,utf8_encode('Cuit: '), 0, 0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(20, 5, $empresa['cuit'],0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(18, 5,utf8_decode('Teléfono: '), 0, 0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(20, 5, $empresa['telefono'],0,1,'L');


        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5,utf8_decode('Direccion: '), 0, 0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(20, 5, $empresa['direccion'],0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 5,utf8_decode('Orden de compra N°: '), 0, 0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(20, 5, $id_compra,0 , 1,'L');
        $pdf->Ln();

        //Encabezado de productos 
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->cell(30,5,'Cant ',0 ,0,'L',true);
        $pdf->cell(60,5,utf8_decode('Descripcion '),0 ,0,'L',true);
        $pdf->cell(50,5,'Precio ',0 ,0,'L',true);
        $pdf->cell(50,5,'Sub total ',0 ,1,'L',true);
        $pdf->SetTextColor(0,0,0);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total +  $row['sub_total'];
            $pdf->cell(30,5,$row['cantidad'],0 ,0,'L');
            $pdf->cell(60,5,utf8_decode($row ['descripcion']),0 ,0,'L');
            $pdf->cell(50,5,$row['precio'],0 ,0,'L');
            $pdf->cell(10,5,number_format($row['sub_total'] ,2 ,'.','.'),0 , 1,'L');
 
        }
        $pdf->Ln();
        $pdf->Cell(160,5, 'Total a pagar', 0, 1, 'R');
        $pdf->Cell(160,5,number_format($total, 2,'.',','), 0, 1, 'R');
       
        $pdf->Output();
    }



    public function historial(){

        $this->views->getView($this, "historial");



    }
    public function listar_historial() {
        $data = $this->model->getHistorialcompras();
        for ($i = 0; $i < count($data); $i++) {
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="'.base_url."Compras/generarPdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';
        
            
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();

    }

}
?>
