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

<legend class="text-center">Lista de proyectos registrados</legend>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
        <thead class="thead">
            <tr>
                <th scope="col"></th>
                <th scope="col">No. Proyecto</th>
                <th scope="col">No. Oficio</th>
                <th scope="col">Fecha</th>
                <th scope="col">Nombre</th>
                <!---->
                <th scope="col">Actividad</th>
                <th scope="col">Tipo Act.</th>
                <th scope="col">Beneficiarios</th>
                <th scope="col">Inversión</th>
                <!---->
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($vars['listaProyecto'] as $item) {
            ?>
                    <tr id="tableContent">
                        <?php 
                            if($item[0] == -1){
                        ?>
                                <td colspan="10" class="text-center">No hay proyectos registrados</td>
                        <?php 
                            }else{
                        ?>
                                <!--
                                <td>
                                    <button id="<?php echo $item[0] ?>" onclick="cargarModalProy(this)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddProgress"> Agregar</button>
                                </td>
                                -->
                                <td>
                                    <button id="<?php echo $item[0] ?>" onclick="cargarLineaTiempo(this)" class="btn btn-dark border">
                                        <img src="public/img/timeline.svg" width="25" height="25" alt="Ver línea de tiempo del proyecto">
                                    </button>
                                </td>
                                <td> <?php echo $item[0] ?> </td>
                                <td> <?php echo $item[1] ?> </td>
                                <td> <?php echo date_format(date_create($item[2]), "d-m-Y") ?> </td>
                                <td> <?php echo $item[3] ?> </td>
                                <!---->
                                <td> <?php echo $item[4] ?> </td>
                                <td> <?php echo $item[5] ?> </td>
                                <td> <?php echo $item[6] ?> </td>
                                <td> <?php echo $item[7] ?> </td>
                                <!---->
                                <?php 
                                    if ($item[8] == -1) {
                                ?>
                                        <td style="background-color: gray;"> Finalizado </td>
                                <?php
                                    }elseif($item[8] == 0){
                                ?>
                                        <td> En espera </td>
                                <?php
                                    }elseif($item[8] == 1){
                                ?>
                                        <td> Aceptado </td>
                                <?php
                                    }elseif($item[8] == 2){
                                ?>
                                        <td> Rechazado </td>
                                <?php
                                    }
                                ?>
                        <?php 
                            }
                        ?>
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
?>

<?php
    include_once 'public/footer.php';
?>