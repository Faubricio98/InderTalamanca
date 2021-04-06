<?php
    include_once 'public/header.php';
    //nos aseguramos que la sesión aun esté activa
    //también se carga al volver a la página de inicio de sesión
    if (!isset($_SESSION['idUserSession'])) {
        include_once 'public/logInAgain.php';
    }else{
        if($_SESSION['idUserSession'] == -1){
            include_once 'public/logInAgain.php';
        }else{
?>      
        <div class="row justify-content-around">
            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/oficio-2.svg" alt="Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Registrar oficio</h5>
                        <p class="card-text text-justify">Acá podrá registrar un nuevo oficio. El número de oficio le aparecerá al final</p>
                        <a href="?controlador=Oficio&accion=mostrarRegistro" class="btn btn-primary stretched-link" style="width: 100%;">Registrar Oficio</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/ver-oficios.svg" alt="Visualizar Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Ver oficios</h5>
                        <p class="card-text text-justify">Acá podrá ver la lista de oficios que se han registrado</p>
                        <a href="?controlador=Oficio&accion=listar" class="btn btn-primary stretched-link" style="width: 100%;">Cargar Oficios</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/upload.svg" alt="Visualizar Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Guardar documento</h5>
                        <p class="card-text text-justify">Acá podrá cargar el documento de un oficio que ya se encuentra registrado</p>
                        <a href="?controlador=Oficio&accion=mostrarUpload" class="btn btn-primary stretched-link" style="width: 100%;">Guardar documento</a>
                    </div>
                </div>
            </div>
        </div>
<?php
        }
    }
?>

<?php
    include_once 'public/footer.php';
?>