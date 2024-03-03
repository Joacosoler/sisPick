<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Arqueo de caja</li>
</ol>
<button class="btn btn-success mb-2" type="button" onclick="arqueoCaja();"><i class="fas fa-plus"></i></button>
<button class="btn btn-warning mb-2" type="button" onclick="cerrarCaja();">Cerrar caja<i></i></button>
<table class="table table-light" id="t_arqueo">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Monto Inicial</th>
            <th>Monto Final</th>
            <th>Fecha Apertura</th>
            <th>Fecha Cierre</th>
            <th>Total Ventas</th>
            <th>Monto Total</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div>
    <div id="abrir_caja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="title">Arqueo Caja</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="frmAbrirCaja" onsubmit="abrirArqueo(event);">
                        <div class="form-group">
                            <label for="monto_inicial">Monto Incial</label>
                            <input type="hidden" id="id" name="id">
                            <input id="monto_inicial" class="form-control" type="text" name="monto_inicial" placeholder="Ingrese el monto Inicial" requiered>
                        </div>
                        <div id="ocultar_campos">
                            <div class="form-group">
                                <label for="monto_final">Monto final</label>
                                <input id="monto_final" class="form-control" type="text" disabled>
                            </div>
                            <div class="form-group">
                                <label for="total_ventas">Total Ventas</label>
                                <input id="total_ventas" class="form-control" type="text" disabled>
                            </div>
                            <div class="form-group">
                                <label for="monto_general">Monto total</label>
                                <input id="monto_general" class="form-control" type="text" disabled>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" id="btnAccion">Abrir Arqueo</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>