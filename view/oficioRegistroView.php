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
    
    <div class="col-12 col-md-10 align-self-center">
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading"> ¡Atención! </h4>
            <hr>
            <p>En esta página podrá registrar un nuevo oficio.</p>
            <span class="text-justify">El oficio no se registrará si no presiona el botón <button class="btn btn-primary">Guardar</button> al final del formulario. Asegúrese de llenar todos los campos, si deja alguno vacío, no se le permitirá registrar el oficio. El nuevo número de oficio se mostrará hasta que se haya completado el registro. La fecha se registrará de manera automática.</span>
        </div>
    </div>
    
    <div class="w-100"></div>

    <div class="col-12 col-sm-10 col-md-7 align-self-center" style="margin-bottom: 1em;">
        <legend class="text-center">Registro de Oficio</legend>
        <input type="text" class="form-control" id="remitente" placeholder="Remitente">
        <input type="text" class="form-control" id="destinatario" placeholder="Destinatario">
        <textarea type="text" class="form-control" rows="5" id="asunto" placeholder="Asunto"></textarea>
        <button type="button" id="saveOficioBtn" class="btn btn-primary" onclick="guardarOficio($('#remitente').val(), $('#destinatario').val(), $('#asunto').val())">Guardar</button>
        <span id="respuesta" class="text-center" style="margin-top: 1.5em;"></span>
    </div>
    
</div>

<?php
        }
    }
?>

<?php
    include_once 'public/footer.php';
?>