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
            <?php 
                if($_SESSION['uploadSession'] == -2){
            ?>
                    <div class="col-12 col-md-10 align-self-center">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"> ¡Atención! </h4>
                            <hr>
                            <p>Ha ocurrido un error al cargar el archivo, vuelva a intentarlo. Si el error persiste, infórmelo de inmediato.</p>
                        </div>
                    </div>
            <?php 
                }
            ?>

            <?php 
                if($_SESSION['uploadSession'] == -1){
            ?>
                    <div class="col-12 col-md-10 align-self-center">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"> ¡Atención! </h4>
                            <hr>
                            <p>El formato del archivo es incorrecto. El formato debe ser <strong>.doc</strong>, <strong>.docx</strong> o <strong>.pdf (preferible)</strong></p>
                        </div>
                    </div>
            <?php 
                }
            ?>

            <?php 
                if($_SESSION['uploadSession'] == 1){
            ?>
                    <div class="col-12 col-md-10 align-self-center">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"> Archivo cargado </h4>
                            <hr>
                            <p>El archivo ha sido cargado con éxito. Si el archivo ya existía, este será sustituido por el que se acaba de cargar</p>
                        </div>
                    </div>
            <?php 
                }
            ?>

            <div class="col-12 col-sm-7 col-md-6 justify-content-center" style="margin-bottom: 1em;">
                <legend class="text-center">Seleccione un archivo para guardar</legend>
                
                <form action="?controlador=Oficio&accion=uploadFile" method="post" enctype="multipart/form-data" class="border border-dark">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input id="uploadFileBtn" type="submit" class="btn btn-primary uploadFileBtn" value="Subir oficio" name="submit">
                </form>

            </div>
        </div>

        <table class="table table-hover table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre del archivo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    foreach ($vars['fileList'] as $item) {
                ?>
                    <tr>
                        <th scope="row"> <?php echo $count ?> </th>
                        <td> <?php print_r($item) ?> </td>
                        <?php
                            if ($documentFileType = strtolower(pathinfo($item, PATHINFO_EXTENSION)) == 'pdf') {
                        ?>
                                <td> <a style="width: 100%;" class="btn btn-primary" href="uploads/<?php print_r($item) ?>">Ver</a> </td>
                        <?php
                            }else{
                        ?>
                                <td> <a style="width: 100%;" class="btn btn-primary" href="uploads/<?php print_r($item) ?>">Descargar</a> </td>
                        <?php
                            }
                        ?>
                    </tr>
                <?php
                        $count++;
                    }
                ?>
            </tbody>
        </table>
<?php
        }
    }
?>

<?php
    include_once 'public/footer.php';
?>