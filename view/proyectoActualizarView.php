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

<div class="row justify-content-center">
    <div class="col-12 col-md-8 align-self-center">
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading"> ¡Atención! </h4>
            <hr>
            <span class="text-justify">Al presionar  <button class="btn btn-dark"> <img src="public/img/plus-1.svg" width="25" height="25" alt="Agregar nuevo avance del proyecto"></button> en la lista, podrá agregar un nuevo avance al proyecto seleccionado.</span>
            <span class="text-justify">Al presionar  <button class="btn btn-dark"> <img src="public/img/timeline.svg" width="25" height="25" alt="Ver línea de tiempo del proyecto"></button> en la lista, se cargará la línea de tiempo de los avances del proyecto.</span>            
        </div>
    </div>
    
    <div class="w-100"></div>

    <div class="col-12 col-sm-12" style="margin-bottom: 1em;">
        <legend class="text-center">Seleccione un proyecto</legend>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-dark">
                <thead class="thead">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">No. Proyecto</th>
                        <th scope="col">No. Oficio</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Nombre</th>
                        <!--
                        <th scope="col">Actividad</th>
                        <th scope="col">Tipo Act.</th>
                        <th scope="col">Beneficiarios</th>
                        <th scope="col">Inversión</th>
                        -->
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
                                        <td colspan="10">No hay proyectos registrados</td>
                                <?php 
                                    }else{
                                ?>
                                        <td>
                                            <button id="<?php echo $item[0] ?>" onclick="cargarModalProy(this)" type="button" class="btnModal btn btn-dark border" data-toggle="modal" data-target="#modalAddProgress">
                                                <img src="public/img/plus-1.svg" width="25" height="25" alt="Agregar nuevo avance del proyecto">
                                            </button>
                                            <button id="<?php echo $item[0] ?>" onclick="cargarLineaTiempo(this)" class="btn btn-dark border">
                                                <img src="public/img/timeline.svg" width="25" height="25" alt="Ver línea de tiempo del proyecto">
                                            </button>
                                        </td>
                                        <td> <?php echo $item[0] ?> </td>
                                        <td> <?php echo $item[1] ?> </td>
                                        <td> <?php echo date_format(date_create($item[2]), "d-m-Y") ?> </td>
                                        <td> <?php echo $item[3] ?> </td>
                                        <!--
                                        <td> <?php echo $item[4] ?> </td>
                                        <td> <?php echo $item[5] ?> </td>
                                        <td> <?php echo $item[6] ?> </td>
                                        <td> <?php echo $item[7] ?> </td>
                                        -->
                                        <?php 
                                            if ($item[8] == -1) {
                                        ?>
                                                <td> Finalizado </td>
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
    </div>

    <!---->
    <div class="modal fade" id="modalAddProgress" tabindex="-1" role="dialog" aria-labelledby="modalAddProgressTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <legend class="text-center">Agregar avance de proyecto</legend>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Número de proyecto: <span id="noProyecto"></span> </span>
                <br>
                <span>Número de Oficio: <span id="noOficio"></span> </span>
                <br>
                <span>Fecha: <span id="feProyecto"></span> </span>
                <br>
                <input type="text" class="form-control" id="nombreProy" placeholder="Nombre">
                <input type="text" class="form-control" id="actividad" placeholder="Actividad a financiar">
                <input type="text" class="form-control" id="tipoActividad" placeholder="Tipo de actividad">
                <input type="text" class="form-control" id="beneficiarios" placeholder="Beneficiarios">
                <input type="number" class="form-control" id="inversion" placeholder="Inversión">
                <div style="margin-top: 1em;">
                    <span>Respuesta:</span> <br>
                    <form name="respuesta">
                        <label class="radio-inline"><input type="radio" name="optradio">En espera</label>
                        <label class="radio-inline"><input type="radio" name="optradio">Aprobado</label>
                        <label class="radio-inline"><input type="radio" name="optradio">Rechazado</label> 
                        <label class="radio-inline"><input type="radio" name="optradio">Finalizado</label> 
                    </form>
                </div>
                <textarea type="text" class="form-control" rows="5" id="cambio" placeholder="Informe del cambio realizado"></textarea>
                
                <span id="respuesta" style="margin-top: 1.5em;" class="text-center"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="actualizarProyecto()">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
        </div>
    <!---->

</div>

<?php
        }
    }
?>

<?php
    include_once 'public/footer.php';
?>