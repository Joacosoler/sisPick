<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pick some Food </title>

    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />

</head>

<body class="bg-success">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"> Bienvenido inicie sesión</h3>
                                </div>
                                <div class="container border text-center">
                                    <img src="<?php echo base_url; ?>Assets/img/icono.ico" class="img-fluid rounded" width="150">
                                </div>
                                <div class="card-body">
                                    <form id="frmLogin">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" />
                                            <label for="inputEmail">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="clave" name="clave" type="password" placeholder="Contraseña" />
                                            <label for="inputPassword">Contraseña</label>
                                        </div>
                                        <div class="alert alert-danger text-center d-none" id="alerta" role="alert">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id=rememberPasswoordCheck" type="checkbox" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Recordar contraseña</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Perdiste la contraseña?</a>
                                            <button type="button" class="btn btn-success" onclick="frmLogin(event)">Iniciar Sesión</button>
                                            
                                        </div 
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                        <div class="small"><a href="refister.html">Registrarse</a><div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Pick Some Food 2022</div>
                        <div>
                            <a href="#">Politicas de Privacidad</a>
                            &middot;
                            <a href="#">Terminos &amp; Condiciones</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>Assets/js/funciones.js"></script>
</body>

</html>