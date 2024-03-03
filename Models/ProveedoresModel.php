<?php
class ProveedoresModel extends Query
{
    private $cuil, $nombre, $telefono, $direccion, $id_categoria, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProveedores()
    {
        $sql = "SELECT p.*, c.id AS id_categoria, c.nombre AS categoria FROM proveedores p INNER JOIN categorias c ON p.id_categoria = c.id where p.estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarProveedor(string $cuil, string $nombre, string $telefono, string $direccion, int $id_categoria)
    {
        $this->cuil = $cuil;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id_categoria = $id_categoria;
        $verificar = "SELECT * FROM proveedores WHERE cuil = '$this->cuil'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO proveedores(cuil, nombre, telefono, direccion, id_categoria) VALUES (?,?,?,?,?)";
            $datos = array($this->cuil, $this->nombre, $this->telefono, $this->direccion, $this->id_categoria);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function modificarProveedor(string $cuil, string $nombre, string $telefono, string $direccion, int $id_categoria, int $id)
    {
        $this->cuil = $cuil;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id_categoria = $id_categoria;
        $this->id = $id;

        $sql = "UPDATE proveedores SET cuil = ?, nombre = ?, telefono = ?, direccion = ?, id_categoria = ? WHERE id = ?";
        $datos = array($this->cuil, $this->nombre, $this->telefono, $this->direccion, $this->id_categoria, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarProv(int $id)
    {
        $sql = "SELECT * FROM proveedores WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionProv(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE proveedores SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permiso d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
