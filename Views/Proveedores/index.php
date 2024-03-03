<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">
        Panel de Proveedores
    </div>
    <div class="card-body">
        <button class="btn btn-success mb-2" type="button" z onclick="frmProveedores();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblProveedores">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Cuil</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="nuevo_proveedores" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="title">Nuevo Proveedores</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="frmProveedores">
                            <div class="form-group">
                                <label for="cuil">Cuil</label>
                                <input type="hidden" id="id" name="id">
                                <input id="cuil" class="form-control" type="text" name="cuil" placeholder="Ingrese el cuil">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Proveedores">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Telefono del proveedor">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input id="direccion" class="form-control" type="text" name="direccion" placeholder="direccion del Proveedores">
                            </div>

                            <div class="form-group mb-2">
                                <label for="categoria">Categoria</label>
                                <select id="categoria" class="form-control mb-2" name="categoria">
                                    <?php foreach ($data['categoria'] as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="button" class="btn btn-success" onclick="registrarProv(event);" id="btnAccion">Registrar</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>