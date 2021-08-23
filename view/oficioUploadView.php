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
        <style>
            form {
                width: 600px;
                background: #ccc;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid black;
            }

            form ol {
                padding-left: 0;
            }

            form li, div > p, div > select {
                background: #eee;
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
                list-style-type: none;
                border: 1px solid black;
            }

            form img {
                height: 64px;
                order: 1;
            }

            form p {
                line-height: 32px;
                padding-left: 10px;
            }

            form label, form button {
                background-color: #7F9CCB;
                padding: 5px 10px;
                border-radius: 5px;
                border: 1px ridge black;
                font-size: 1rem;
                height: auto;
            }

            form label:hover, form button:hover {
                background-color: #2D5BA3;
                color: white;
            }

            form label:active, form button:active {
                background-color: #0D3F8F;
                color: white;
            }
        </style>
        <div class="row justify-content-around">
            <?php 
                if($_SESSION['uploadSession'] == -2){
            ?>
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Atención!',
                            text: 'Ha ocurrido un error al cargar el archivo, vuelva a intentarlo. Si el error persiste, infórmelo de inmediato.',
                            showConfirmButton: true
                        });
                    </script>
            <?php 
                }
            ?>

            <?php 
                if($_SESSION['uploadSession'] == -1){
            ?>
                    <script>
                        Swal.fire({
                            icon: 'info',
                            title: '¡Atención!',
                            html: 'El formato del archivo es incorrecto. El formato debe ser <strong>.doc</strong>, <strong>.docx</strong> o <strong>.pdf (preferible)</strong>.',
                            showConfirmButton: true
                        });
                    </script>
            <?php 
                }
            ?>

            <?php 
                if($_SESSION['uploadSession'] == 1){
            ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Archivo cargado',
                            text: 'El archivo ha sido cargado con éxito. Si el archivo ya existía, este será sustituido por el que se acaba de cargar.',
                            showConfirmButton: true
                        });
                    </script>
            <?php 
                }
            ?>

            <div class="col-12 col-sm-7 col-md-6 justify-content-center" style="margin-bottom: 1em;">
                <legend class="text-center">Seleccione un archivo para guardar</legend>
                <form action="?controlador=Oficio&accion=uploadFile" method="post" enctype="multipart/form-data" class="border border-dark">
                    <div>
                        <label for="fileToUpload">Seleccione un achivo <strong>.doc</strong>, <strong>.docx</strong> o <strong>.pdf (preferible)</strong></label>
                        <input type="file" name="fileToUpload" id="fileToUpload" accept = ".doc, .docx, .pdf">
                    </div>
                    <div class="preview">
                        <p>No se ha seleccionado ningún archivo</p>
                    </div>
                    <div>
                        <select name="selectIdOficio" id="selectIdOficio">
                            <option value="0"> Seleccione un oficio </option>
                            <?php 
                                foreach ($vars['listaOficio'] as $item) {
                            ?>
                                    <option value="<?php echo $item[0] ?>"> <?php echo $item[0] ?> </option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <button>Guardar archivo</button>
                    </div>
                </form>
                <script type="text/javascript" src="public/js/scriptUpload.js"></script>
            </div>
        </div>

        <table class="table table-hover table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Número de oficio</th>
                    <th scope="col">Nombre del archivo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if (sizeof($vars['fileList']) == 0) {
                ?>
                        <td colspan="4" class="text-center">No hay archivos guardados</td>
                <?php
                    }
                    foreach ($vars['fileList'] as $item) {
                ?>
                        <tr>
                            <th scope="row"> <?php echo $item[0] ?> </th>
                            <td> <?php echo $item[1] ?> </td>
                            <td> <?php echo $item[2] ?> </td>
                            <?php
                                if (strtolower(pathinfo($item[2], PATHINFO_EXTENSION)) == 'pdf') {
                            ?>
                                    <td> <a style="width: 100%;" class="btn btn-primary" href="uploads/<?php echo $item[2] ?>" target="_blank">Ver</a> </td>
                            <?php
                                }else{
                            ?>
                                    <td> <a style="width: 100%;" class="btn btn-primary" href="uploads/<?php echo $item[2] ?>">Descargar</a> </td>
                            <?php
                                }
                            ?>
                        </tr>
                <?php
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