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

<div class="row justify-content-center">
    
    <div class="col-12 col-sm-10 col-md-6 align-self-center" style="margin-bottom: 1em;">
        <legend class="text-center">Registro de nuevos usuarios <i class="fi-br-interrogation" onclick="infoUser()" style="margin-left: 0.5em;"></i></legend>
        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
        <input type="text" class="form-control" id="apellidos" placeholder="Apellidos">
        <input type="text" class="form-control" id="email" placeholder="Correo electrónico">
        <input type="password" class="form-control" id="pass" placeholder="Contraseña">
        <input type="password" class="form-control" id="passConfirm" placeholder="Confirmar contraseña">
        <label style="margin-top: 1em;" class="checkbox-inline"><input type="checkbox" id="checkAdmin"> Administrador</label>
        <i class="fi-br-interrogation" onclick="infoAdmin()" style="margin-left: 0.5em;"></i>
        <button type="button" id="saveOficioBtn" class="btn btn-primary" onclick="guardarUsuario()">Guardar</button>
        <span id="respuesta" class="text-center" style="margin-top: 1.5em;"></span>
    </div>

    <script>
        function infoAdmin() {
            Swal.fire({
                icon: 'info',
                title: 'Información',
                text: 'Al marcar la casilla de "Administrador" está indicando que el nuevo usuario será también administrador de esta página.',
                showConfirmButton: false,
                //timer: 3000,
                //timerProgressBar: true,
            });
        }

        function infoUser(){
            Swal.fire({
                icon: 'info',
                title: 'Información',
                text: 'Esta página le permitirá registrar nuevos usuarios. No debe ingresar solo números, pues el sistema entenderá que está dejando el espacio vacío y no le permitirá registrar ningún usuario',
                showConfirmButton: false,
                //timer: 3000,
                //timerProgressBar: true,
            });
        }
    </script>

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