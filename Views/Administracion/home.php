<?php include "Views/Templates/header.php"; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Panel Administrativo </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Panel de administación</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-3 col-sm-6">
            <div class="card bg-primary text-white ">
                <div class="card-body d-flex text-white">
                    Usuarios
                    <i class="fas fa-user fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo base_url; ?>Usuarios">Ver Detalle</a>
                    <span class="small text-white"><?php echo $data['usuarios']['total'] ?></span>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body d-flex text-white">
                    Clientes
                    <i class="fas fa-users fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo base_url; ?>Clientes">Ver Detalle</a>
                    <span class="small text-white"><?php echo $data['clientes']['total'] ?></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mb-4">
                <div class="card-body d-flex text-white">
                    Proveedores
                    <i class="fas fa-shipping-fast fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo base_url; ?>Proveedores">Ver Detalle</a>
                    <span class="small text-white"><?php echo $data['proveedores']['total'] ?></span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body d-flex text-white">
                    Productos
                    <i class="fab fa-product-hunt fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo base_url; ?>Productos">Ver Detalle</a>
                    <span class="small text-white"><?php echo $data['productos']['total'] ?></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white ">
                <div class="card-body d-flex text-white">
                    Ventas
                    <i class="fas fa-cash-register fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo base_url; ?>Productos">Ver Detalle</a>
                    <span class="small text-white"><?php echo $data['ventas']['total'] ?></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
            <div class="card bg-warning text-white ">
                <div class="card-body d-flex text-white">
                    Categorias
                    <i class="fa fa-tags fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo base_url; ?>Categorias">Ver Detalle</a>
                    <span class="small text-white"><?php echo $data['categorias']['total'] ?></span>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
            <div class="card bg-info text-white ">
                <div class="card-body d-flex text-white">
                    Medidas
                    <i class="fas fa-user fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo base_url; ?>Medidas">Ver Detalle</a>
                    <span class="small text-white"><?php echo $data['medidas']['total'] ?></span>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
            <div class="card bg-dark mb-4">
                <div class="card-body d-flex text-white">
                    Cajas
                    <i class="fas fa-box fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo base_url; ?>Usuarios">Ver Detalle</a>
                    <span class="small text-white">0</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
            <div class="card bg-secondary mb-4">
                <div class="card-body d-flex text-white">
                    Compras
                    <i class="fas fa-cash-register fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>Compras">Ver Detalle</a>
                    <span class="small text-white"><?php echo $data['compras']['total'] ?></span>

                </div>
            </div>
        </div>


    </div>

    <div class="row mt-2 ">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Productos que tienen stock minimo
                </div>
                <div class="card-body">
                    <canvas id="stockMinimo" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Producto mas vendidos

                </div>
                <div class="card-body">
                    <canvas id="productosVendidos" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    <?php include "Views/Templates/footer.php"; ?>