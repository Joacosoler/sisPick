<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">
        Panel de gestión de Clientes
    </div>
    <div class="card-body">
        <button class="btn btn-success mb-2" type="button" z onclick="frmCliente();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblClientes">
                <tbody>
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Dni</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>

                </tbody>
            </table>
        </div>
        <div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="title">Ingrese el nuevo Cliente</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="frmCliente">
                            <div class="form-group">
                                <label for="dni">Dni</label>
                                <input type="hidden" id="id" name="id">
                                <input id="dni" class="form-control" type="text" name="dni" placeholder="Documento de identidad">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del cliente">
                            </div>
                            <div class="form-group">
                                <label for="telefono"> Teléfono</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <textarea id="direccion" class="form-control" name="direccion" rows="3" placeholder="Dirección"></textarea>
                            </div>
                    
                            <button type="button" class="btn btn-success" onclick="registrarCli(event);" id="btnAccion">Registrar</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>