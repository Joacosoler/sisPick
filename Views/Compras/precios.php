<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header bg-success text-white ">
        <h4>Nueva solicitud de precios</h4>
    </div>
    <div class="card-body">
        <form id="frmprecios">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="codigo"><i class="fas fa-barcode "></i>Codigo de barras</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo de barras" onkeyup="buscarCodigo(event)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group ">
                        <label for="productos">Descripcion</label>
                        <select id="productos" class="form-control" name="productos">
                            <?php foreach ($data['productos'] as $row) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['descripcion']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" onkeyup="calcularPrecio(event)">
                    </div>
                </div>
          
            </div>
        </form>
    </div>
</div>
<table class="table table-light table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Descripcion</th>
            <th>Cantidad</th>

            <th></th>
        </tr>
    </thead>
    <tbody id="tblDetallePrecios">
    </tbody>
</table>
<div class="col-md-4 ml-auto">
    <div class="form-group">
        <label for="total" class="font-weight-bold">Total</label>
        <input id="total" class="form-control" type="number" name="total" placeholder="Total" disabled>
        <button class="btn btn-success mt-2 btn-block" type="button" onclick = "generarVenta() ">Generar Compra</button>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>