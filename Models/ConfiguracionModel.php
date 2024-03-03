<?php
class ConfiguracionModel extends Query{
    public function __construct()
    {
        parent::__construct();

    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }
    public function modificarDatos( string $nombre, string $cuit, string $telefono, string $direccion, string $mensaje, int $id)

    {

        $sql = "UPDATE  empresa SET nombre = ? , cuit = ?,  telefono = ? , direccion = ?, mensaje = ? WHERE id = ? ";
        $datos = array($nombre, $cuit,  $telefono, $direccion, $mensaje, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }

        return $res;
    }
    public function getStockMinimo()
    {
        $sql = "SELECT * FROM productos WHERE cantidad < 15 ORDER BY cantidad DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }


}
?>