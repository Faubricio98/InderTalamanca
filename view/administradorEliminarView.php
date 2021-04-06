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

<legend class="text-center">Seleccione un usuario para eliminar</legend>
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
                            <td> <i id="<?php echo $item[0] ?>" onclick="eliminarUsuario(this)" style="color: red;" class="fi-br-trash"></i> </td>
                        </tr>
                <?php
                    }
                ?>
        </tbody>
    </table>
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