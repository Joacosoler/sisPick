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
        $verificar = $this->model->verificarPermiso($id_user, 'compras');
        if (!empty($verificar) || $id_user == 1) {
            //$data =$this->model->getCompras();
            $data['proveedores'] = $this->model->getProveedores();
            $data['clientes'] = $this->model->getClientes();
            $data['productos'] = $this->model->getProductosPrecios();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
    }

    public function precios()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'compras');
        if (!empty($verificar) || $id_user == 1) {
            //$data =$this->model->getCompras();
            $data['proveedores'] = $this->model->getProveedores();
            $data['productos'] = $this->model->getProductosPrecios();

            $this->views->getView($this, "precios", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
    }
    public function ventas()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'compras');
        if (!empty($verificar) || $id_user == 1) {
            //$data =$this->model->getCompras();
            $data['clientes'] = $this->model->getClientes();
            $this->views->getView($this, "ventas", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
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
        $comprobar = $this->model->consultarDetalle('detalle', $id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle('detalle', $id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = array('msg' => 'Producto ingresado a la compra', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al ingresar el producto', 'icono' => 'error');
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle('detalle', $precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = array('msg' => 'Producto Actualizado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al actualizar el producto', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresarVenta()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalle('detalle_temp', $id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle('detalle_temp', $id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = array('msg' => 'Producto ingresado a la venta', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al ingresar el producto a la venta', 'icono' => 'error');
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle('detalle_temp', $precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = array('msg' => 'Producto Actualizado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al actualizar el producto', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresarPrecios()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];;
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetallePrecios($id_producto, $id_usuario);
        if (empty($comprobar)) {
            $data = $this->model->registrarDetallePrecios($id_producto, $id_usuario, $cantidad);
            if ($data == "ok") {
                $msg = "ok";
            } else {
                $msg = "error al ingresar el producto";
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $data = $this->model->actualizarDetalle($total_cantidad, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "error al modificar el producto";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar($table)
    {

        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($table, $id_usuario);
        $data['total_pagar'] = $this->model->calcularCompra($table, $id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listarPrecios()
    {

        $id_usuario = $_SESSION['id_usuario'];
        $data['detallesolicitud'] = $this->model->getDetallePrecios($id_usuario);
        $data['total_pagar'] = $this->model->calcularCompra($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function delete($id)
    {

        $data = $this->model->deleteDetalle('detalle', $id);
        if ($data == 'ok') {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        echo json_encode($msg);
        die();
    }
    public function deleteVenta($id)
    {

        $data = $this->model->deleteDetalle('detalle_temp', $id);
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
        $total = $this->model->calcularCompra('detalle', $id_usuario);
        $data = $this->model->registrarCompra($total['total']);
        if ($data == 'ok') {
            $detalle = $this->model->getDetalle('detalle', $id_usuario);
            $id_compra = $this->model->getId('compras');
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $id_pro = $row['id_producto'];
                $sub_total = $cantidad * $precio;
                $this->model->registrarDetalleCompra($id_compra['id'], $id_pro, $cantidad, $precio, $sub_total);
                $stock_actual = $this->model->getProductos($id_pro);
                $stock = $stock_actual['cantidad'] + $cantidad;
                $this->model->actualizarStock($stock, $id_pro);
            }
            $vaciar = $this->model->vaciarDetalle('detalle', $id_usuario);
            if ($vaciar == 'ok') {
                $msg = array('msg' => 'ok', 'id_compra' => $id_compra['id']);
            }
        } else {
            $msg = 'error a realizar la orden de compra';
        }
        echo json_encode($msg);
        die();
    }
    public function registrarVenta($id_cliente)
    {   
        $id_usuario = $_SESSION['id_usuario'];
        $verificar=$this->model->verificarCaja($id_usuario);
        if (empty($verificar)) {
            $msg= 'La caja esta cerrrada';

        }else{
            $total = $this->model->calcularCompra('detalle_temp', $id_usuario);
            $data = $this->model->registrarVenta($id_usuario,$id_cliente, $total['total']);
            if ($data == 'ok') {
                $detalle = $this->model->getDetalle('detalle_temp', $id_usuario);
                $id_venta = $this->model->getId('ventas');
                foreach ($detalle as $row) {
                    $cantidad = $row['cantidad'];
                    $desc = $row['descuento'];
                    $precio = $row['precio'];
                    $id_pro = $row['id_producto'];
                    $sub_total = ($cantidad * $precio) - $desc;
                    $this->model->registrarDetalleVenta($id_venta['id'], $id_pro, $cantidad, $desc, $precio, $sub_total);
                    $stock_actual = $this->model->getProductos($id_pro);
                    $stock = $stock_actual['cantidad'] + $cantidad;
                    $this->model->actualizarStock($stock, $id_pro);
                }
                $vaciar = $this->model->vaciarDetalle('detalle_temp', $id_usuario);
                if ($vaciar == 'ok') {
                    $msg = array('msg' => 'ok', 'id_venta' => $id_venta['id']);
                }
            } else {
                $msg = 'error a realizar la orden de venta';
            }


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
        $pdf->Cell(60, 10, 'Orden de compra', 0, 1, 'C');
        $pdf->Image(base_url . 'Assets/img/ico.png', 180, 5, 25, 25);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(19, 5, 'Nombre: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['nombre'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(10, 5, utf8_encode('Cuit: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['cuit'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(18, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');


        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_decode('Direccion: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['direccion'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 5, utf8_decode('Orden de compra N°: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $id_compra, 0, 1, 'L');
        $pdf->Ln();

        //Encabezado de productos 
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->cell(30, 5, 'Cant ', 0, 0, 'L', true);
        $pdf->cell(60, 5, utf8_decode('Descripcion '), 0, 0, 'L', true);
        $pdf->cell(50, 5, 'Precio ', 0, 0, 'L', true);
        $pdf->cell(50, 5, 'Sub total ', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total +  $row['sub_total'];
            $pdf->cell(30, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->cell(60, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->cell(50, 5, $row['precio'], 0, 0, 'L');
            $pdf->cell(10, 5, number_format($row['sub_total'], 2, '.', '.'), 0, 1, 'L');
        }
        $pdf->Ln();
        $pdf->Cell(160, 5, 'Total a pagar', 0, 1, 'R');
        $pdf->Cell(160, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Output();
    }



    public function historial()
    {

        $this->views->getView($this, "historial");
    }
    public function historial_ventas()
    {

        $this->views->getView($this, "historial_ventas");
    }
    public function listar_historial()
    {
        $data = $this->model->getHistorialcompras();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Completado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-warning" onclick="btnAnularC(' . $data[$i]['id'] . ')"> <i class="fas fa-ban"></i></button>
                <a class="btn btn-danger" href="' . base_url . "Compras/generarPdf/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Anulado</span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="' . base_url . "Compras/generarPdf/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar_historial_venta()
    {
        $data = $this->model->getHistorialVentas();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="' . base_url . "Compras/generarPdfVenta/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function generarPdfVenta($id_venta)

    {

        $empresa = $this->model->getEmpresa();
        $descuento = $this->model->getDescuento($id_venta);
        $productos = $this->model->getProVenta($id_venta);

        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Ticket Venta');
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->Cell(60, 10, 'Ticket de venta', 0, 1, 'C');
        $pdf->Image(base_url . 'Assets/img/ico.png', 180, 5, 25, 25);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(19, 5, 'Nombre: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['nombre'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(10, 5, utf8_encode('Cuit: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['cuit'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(18, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');


        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_decode('Direccion: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['direccion'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 5, utf8_decode('Ticket de venta N°: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $id_venta, 0, 1, 'L');
        $pdf->Ln();
        //Encabezado de Clientes 
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->cell(30, 5, 'Nombre ', 0, 0, 'L', true);
        $pdf->cell(60, 5, utf8_decode('Telefono '), 0, 0, 'L', true);
        $pdf->cell(50, 5, 'Direccion ', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $clientes = $this->model->clientesVenta($id_venta);
        $pdf->cell(30, 5, $clientes['nombre'], 0, 0, 'L');
        $pdf->cell(60, 5, utf8_decode($clientes['telefono']), 0, 0, 'L');
        $pdf->cell(30, 5, $clientes['direccion'], 0, 1, 'L');




        $pdf->Ln();
        //Encabezado de productos 
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->cell(30, 5, 'Cant ', 0, 0, 'L', true);
        $pdf->cell(60, 5, utf8_decode('Descripcion '), 0, 0, 'L', true);
        $pdf->cell(50, 5, 'Precio ', 0, 0, 'L', true);
        $pdf->cell(50, 5, 'Sub total ', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total +  $row['sub_total'];
            $pdf->cell(30, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->cell(60, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->cell(50, 5, $row['precio'], 0, 0, 'L');
            $pdf->cell(10, 5, number_format($row['sub_total'], 2, '.', '.'), 0, 1, 'L');
        }
        $pdf->Ln();
        $pdf->Cell(160, 5, 'Descuento Total', 0, 1, 'R');
        $pdf->Cell(160, 5, number_format($descuento['total'], 2, '.', ','), 0, 1, 'R');
        $pdf->Cell(160, 5, 'Total a pagar', 0, 1, 'R');
        $pdf->Cell(160, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Output();
    }


    public function calcularDescuento($datos)
    {


        $array = explode(",", $datos);
        $id = $array[0];
        $desc = $array[1];
        if (empty($id) || empty($desc)) {
            $msg = array('msg' => 'Error', 'icono' => 'error');
        } else {
            $descuento_actual = $this->model->verificarDescuento($id);
            $descuento_total = $descuento_actual['descuento'] + $desc;
            $sub_total = (($descuento_actual['cantidad'] * $descuento_actual['precio']) - $descuento_total);
            $data = $this->model->actualizarDescuento($descuento_total, $sub_total, $id);
            if ($data == 'ok') {
                $msg = array('msg' => 'Descuento aplicado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al aplicar descuento', 'icono' => 'error');
            }
        }
        echo json_encode($msg);
        die();
    }
    public function anularCompra($id_compra)
    {

        $data = $this->model->getAnularCompra($id_compra);
        $anular = $this->model->getAnular($id_compra);
        foreach ($data as $row) {
            $stock_actual = $this->model->getProductos($row['id_producto']);
            $stock = $stock_actual['cantidad'] - $row['cantidad'];
            $this->model->actualizarStock($stock, $row['id_producto']);
        }
        if ($anular == 'ok') {
            $msg = array('msg' => 'Compra anulada', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al anular', 'icono' => 'error');
        }
        echo json_encode($msg);
        die();
    }
}
