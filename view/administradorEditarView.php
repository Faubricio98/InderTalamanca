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

<legend class="text-center">Seleccione un usuario para editar</legend>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
        <thead class="thead">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Administrador</th>
            </tr>
        </thead>
        <tbody id="tablaContenido">
                <?php
                    foreach ($vars['listaUsuarios'] as $item) {
                ?>
                        <tr>
                            <th scope="row"> <?php echo $item[0] ?> </th>
                            <td> <?php echo $item[1] ?> </td>
                            <td> <?php echo $item[2] ?> </td>
                            <td> <?php echo $item[3] ?> </td>
                            <?php 
                                if ($item[4] == 1) {
                            ?>
                                    <td> <i class="fi-br-check"></i> </td>
                            <?php 
                                }else{
                            ?>
                                    <td> <i class="fi-br-cross"></i> </td>
                            <?php 
                                }
                            ?>
                            <!--<td> <button class="btn btn-dark border"><i style="color: red;" class="fi-br-cross"></i></button> </td>-->
                            <td> <i id="<?php echo $item[0] ?>" onclick="cargarModalEditUser(this)" style="color: #2eabcf;" class="fi-br-edit" data-toggle="modal" data-target="#modalAddProgress"></i> </td>
                        </tr>
                <?php
                    }
                ?>
        </tbody>
    </table>
</div>

<!---->
<div class="modal fade" id="modalAddProgress" tabindex="-1" role="dialog" aria-labelledby="modalAddProgressTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <legend class="text-center">Editar un usuario</legend>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <span>ID: <span id="idUser"></span> </span>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            <input type="text" class="form-control" id="apellidos" placeholder="Apellidos">
            <input type="text" class="form-control" id="email" placeholder="Correo electrónico">
            <label style="margin-top: 1em;" class="checkbox-inline"><input type="checkbox" id="checkAdmin"> Administrador</label>
            <i class="fi-br-interrogation" onclick="infoAdmin()" style="margin-left: 0.5em;"></i>
            <span id="respuesta" class="text-center" style="margin-top: 1.5em;"></span>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="editarUsuario()">Editar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
    <!---->

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

<?php
                }
            }
        }
    }
?>

<?php
    include_once 'public/footer.php';
?>