<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">
        Panel de gestión de Productos
    </div>
    <div class="card-body">
        <button class="btn btn-success mb-2" type="button" z onclick="frmProducto();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblProductos">
                <tbody>
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Foto</th>
                            <th>Código</th>
                            <th>Descripcion</th>
                            <th>Proveedores</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                </tbody>
            </table>
        </div>
        <div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="title">Nuevo Producto</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="frmProducto">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo">Codigo de barras</label>
                                        <input type="hidden" id="id" name="id">
                                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Descripcion</label>
                                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripcion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio_compra">Precio Compra</label>
                                        <input id="precio_compra" class="form-control" type="text" name="precio_compra" placeholder="Precio compra">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio_venta">Precio Venta</label>
                                        <input id="precio_venta" class="form-control" type="text" name="precio_venta" placeholder="Precio Venta">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="medida">Medidas</label>
                                            <select id="medida" class="form-control mb-2" name="medida">
                                                <?php foreach ($data['medidas'] as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="categoria">Categorias</label>
                                            <select id="categoria" class="form-control mb-2" name="categoria">
                                                <?php foreach ($data['categorias'] as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="proveedores">Proveedores</label>
                                            <select id="proveedores" class="form-control mb-2" name="proveedores">
                                                <?php foreach ($data['proveedores'] as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <div class="card border-primary">
                                                <div class="card-body">
                                                    <label for="imagen" id="icon-image" class="btn btn-primary"><i class="fas fa-image"></i></label>
                                                    <span id="icon-cerrar"> </span>
                                                    <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event)">
                                                    <input type="hidden" id="foto_actual" name="foto_actual"> 
                                                    <img class="img-thumbnail" id="img-preview">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success" onclick="registrarPro(event);" id="btnAccion">Registrar</button>
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>