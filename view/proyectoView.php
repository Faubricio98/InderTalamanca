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
                    <img class="card-img-top" src="public/img/proyecto-2.svg" alt="Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Registrar proyecto</h5>
                        <p class="card-text text-justify">Acá podrá registrar un nuevo proyecto. El número de oficio le aparecerá al final</p>
                        <a href="?controlador=Proyecto&accion=mostrarRegistro" class="btn btn-primary stretched-link" style="width: 100%;">Registrar Proyecto</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/actualizar-proyecto.svg" alt="Visualizar Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Agregar avance</h5>
                        <p class="card-text text-justify">Acá podrá registrar el avance de los proyectos que se han registrado</p>
                        <a href="?controlador=Proyecto&accion=mostrarActualizar" class="btn btn-primary stretched-link" style="width: 100%;">Actualizar proyecto</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/mystery.svg" alt="Visualizar Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Ver proyectos</h5>
                        <p class="card-text text-justify">Acá podrá visualizar la lista de proyectos que ya han sido registrados</p>
                        <a href="?controlador=Proyecto&accion=mostrarListar" class="btn btn-primary stretched-link" style="width: 100%;">Cargar proyectos</a>
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