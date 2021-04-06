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
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            if (window.sessionStorage.getItem("initCount") == 0) {
                Toast.fire({
                    icon: 'success',
                    title: '¡Hola <?php echo $_SESSION['nomUserSession'] ?>! Bienvenido/a'
                })
                window.sessionStorage.setItem("initCount", 1);
            }
        </script>
        
        <div class="row justify-content-around">
            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/oficio-1.svg" alt="Oficios" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Oficios</h5>
                        <p class="card-text text-justify">Acá podrá registrar un nuevo oficio y ver la lista de los que ya se encuentran registrados.</p>
                        <a href="?controlador=Oficio&accion=mostrar" class="btn btn-primary stretched-link" style="width: 100%;">Ver</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                <div class="card">
                    <img class="card-img-top" src="public/img/proyecto-1.svg" alt="Proyectos" style="margin-top:1em; height: 125px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Proyectos</h5>
                        <p class="card-text text-justify">Acá podrá registrar y actualizar un nuevo proyecto, ver la lista de los que ya están registrados.</p>
                        <a href="?controlador=Proyecto&accion=mostrar" class="btn btn-primary stretched-link" style="width: 100%;">Ver</a>
                    </div>
                </div>
            </div>

            <?php
                if (isset($_SESSION['adminUserSession'])) {
                    if($_SESSION['adminUserSession'] == 1){
            ?>
                        <div class="col-12 col-sm-7 col-md-6 col-lg-3 align-self-center" style="margin-bottom: 1em;">
                            <div class="card">
                                <img class="card-img-top" src="public/img/user.svg" alt="Visualizar Oficios" style="margin-top:1em; height: 125px;">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Usuarios</h5>
                                    <p class="card-text text-justify">Acá podrá administrar a los usuarios del sistema, esta función es solo para administradores</p>
                                    <a href="?controlador=Administrador&accion=mostrar" class="btn btn-primary stretched-link" style="width: 100%;">Ver</a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
<?php
        }
    }
?>

<?php
    include_once 'public/footer.php';
?>