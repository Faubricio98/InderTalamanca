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
            if(!isset($_SESSION['adminUserSession'])){
                include_once 'public/logInAgain.php';
            }else{
                if($_SESSION['adminUserSession'] == 0){
                    include_once 'view/error403View.php';
                }else{
?>
        <div class="row justify-content-around">
            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/add-user.svg" alt="Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Agregar usuario</h5>
                        <p class="card-text text-justify">Acá podrá registrar un nuevo usuario en el sistema.</p>
                        <a href="?controlador=Administrador&accion=mostrarRegistrar" class="btn btn-primary stretched-link" style="width: 100%;">Ver</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/edit-user.svg" alt="Proyectos" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Editar usuario</h5>
                        <p class="card-text text-justify">Acá podrá editar la información de los usuarios del sistema.</p>
                        <a href="?controlador=Administrador&accion=mostrarEditar" class="btn btn-primary stretched-link" style="width: 100%;">Ver</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/del-user.svg" alt="Visualizar Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Eliminar usuario</h5>
                        <p class="card-text text-justify">Acá podrá eliminar a un usuario del sistema.</p>
                        <a href="?controlador=Administrador&accion=mostrarEliminar" class="btn btn-primary stretched-link" style="width: 100%;">Ver</a>
                    </div>
                </div>
            </div>
        </div>
<?php
        
                }
            }
        }
    }
?>

<?php
    include_once 'public/footer.php';
?>