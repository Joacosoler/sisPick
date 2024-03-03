<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">
        Panel de gestión de Categorias
    </div>
    <div class="card-body">
        <button class="btn btn-success mb-2" type="button" z onclick="frmCategoria();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblCategorias">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div>
                <div id="nuevo_categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title text-white" id="title">Ingrese la nueva categoria</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="frmCategoria">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="hidden" id="id" name="id">
                                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre de la categoria">
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="registrarCat(event);" id="btnAccion">Registrar</button>
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "Views/Templates/footer.php"; ?>