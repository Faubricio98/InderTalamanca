<?php
    include_once 'public/header.php';
?>

<div class="row justify-content-center align-content-center">
    <div class="col-11 col-sm-10 col-md-4 border">
        <legend class="text-center">Oficios y Proyectos</legend>
        <input id="user_name" class="form-control" type="text" placeholder="Nombre de usuario">
        <input id="user_pass" class="form-control" type="password" placeholder="Contraseña">
        <button id="logInBtn" onclick="logInUser($('#user_name').val(), $('#user_pass').val())" class="btn btn-primary">Iniciar Sesion</button>
        <br></br>
        <span id="respuesta" class="text-center"></span>
    </div>
</div>

<?php
    include_once 'public/footer.php';
?>