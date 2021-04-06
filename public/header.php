<!DOCTYPE html>
<html lang="es">

<head>
    <title>INDER - Oficios y Proyectos</title>
	<meta charset="utf-8"/>
	<meta name="description" content="INDER - Oficios y Proyectos de la Oficina Regional de Talamanca y Valle de la Estrella" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="public/img/logo.png">

    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" type="text/css" href="public/css/uicons-bold-rounded/css/uicons-bold-rounded.css"/>
    <script type="text/javascript" src="public/js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="public/js/script.js"></script>
    <script type="text/javascript" src="public/js/scriptAdministrador.js"></script>
    <script type="text/javascript" src="public/js/scriptIndex.js"></script>
    <script type="text/javascript" src="public/js/scriptOficio.js"></script>
    <script type="text/javascript" src="public/js/scriptProyecto.js"></script>
    <script type="text/javascript" src="public/js/scriptUsuario.js"></script>

    <script src="https://unpkg.com/promise-polyfill@7.1.0/dist/polyfill.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@latest/dist/sweetalert2.all.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
            crossorigin="anonymous">
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" 
        crossorigin="anonymous">
    </script>
    <style>
        body {
            font-family: 'Lato', sans-serif;
        }

        .overlay {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 5;
            top: 0;
            left: 0;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0, 0.8);
            overflow-x: hidden;
            transition: 0.5s;
        }

        .overlay-content {
            position: relative;
            top: 8%;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        .overlay a {
            padding: 5px;
            text-decoration: none;
            font-size: 36px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .overlay a:hover, .overlay a:focus {
            color: #f1f1f1;
        }

        .overlay .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        @media (max-width: 600px) {
            .overlay a {
                font-size: 25px
            }
            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
        }
    </style>
</head>

<body>
    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="?controlador=Usuario&accion=mostrar">Inicio</a>
            <a href="?controlador=Oficio&accion=mostrarRegistro">Registrar oficios</a>
            <a href="?controlador=Oficio&accion=listar">Lista de oficios</a>
            <a href="?controlador=Proyecto&accion=mostrarRegistro">Registrar proyectos</a>
            <a href="?controlador=Proyecto&accion=mostrarActualizar">Actualizar proyectos</a>
            <a href="?controlador=Proyecto&accion=mostrarListar">Lista de proyectos</a>
            <?php
                if (isset($_SESSION['adminUserSession'])) {
                    if($_SESSION['adminUserSession'] == 1){
            ?>
                        <a href="?controlador=Administrador&accion=mostrarRegistrar">Registrar usuario</a>
                        <a href="?controlador=Administrador&accion=mostrarEditar">Editar usuario</a>
                        <a href="?controlador=Administrador&accion=mostrarEliminar">Eliminar usuario</a>
            <?php
                    }
                }
            ?>
            <a href="?controlador=Usuario&accion=logUsuarioOut">Cerrar sesión</a>
        </div>
    </div>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
            <?php
                if (isset($_SESSION['idUserSession'])) {
                    if ($_SESSION['idUserSession'] != -1) {
            ?>
                        <span style="font-size:30px; cursor:pointer;" onclick="openNav()"> <i class="fi-br-menu-burger the-logo" style="color: white;"></i> </span>
                        <a href="?controlador=Usuario&accion=mostrar">
                            <img class="the-logo" src="public/img/logo-talamanca-vallelaestrella.png" width="70" height="80">
                        </a>
                        <legend class="the-legend">Oficina Regional de Talamanca y Valle de la Estrella</legend>
                        
                        <button id="logOutBtn" onclick="logOutUser()" class="btn text-white border">Cerrar Sesión</button>
            <?php    
                    }else{
            ?>
                        <a href="index.php">
                            <img class="the-logo" src="public/img/logo-talamanca-vallelaestrella.png" width="70" height="80">
                        </a>
                        <legend class="the-legend">Oficina Regional de Talamanca y Valle de la Estrella</legend>
            <?php
                    }
                }else{
            ?>
                    <a href="index.php">
                        <img class="the-logo" src="public/img/logo-talamanca-vallelaestrella.png" width="70" height="80">
                    </a>
                    <legend class="the-legend">Oficina Regional de Talamanca y Valle de la Estrella</legend>
            <?php
                }
            ?>
        </nav>
        <script>
            function openNav() {
                document.getElementById("myNav").style.width = "100%";
            }

            function closeNav() {
                document.getElementById("myNav").style.width = "0%";
            }
        </script>
    </header>

    <div id="contenido">
        <div id="main-container" class="jumbotron-fluid" style="margin-top: 2em; padding-right: 1em; padding-left: 1em;">