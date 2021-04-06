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

<legend class="text-center">Lista de Oficios registrados</legend>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
        <thead class="thead">
            <tr>
                <th scope="col">No. Oficio</th>
                <th scope="col">Fecha</th>
                <th scope="col">Remitente</th>
                <th scope="col">Destinatario</th>
                <th scope="col">Asunto</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    foreach ($vars['listaOficio'] as $item) {
                ?>
                        <tr>
                            <th scope="row"> <?php echo $item[0] ?> </th>
                            <td> <?php echo date_format(date_create($item[1]), "d-m-Y") ?> </td>
                            <td> <?php echo $item[2] ?> </td>
                            <td> <?php echo $item[3] ?> </td>
                            <td> <?php echo $item[4] ?> </td>
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