<?php

class AdministradorController{

    public function __construct() {
        $this->view = new View();
    } // constructor

    public function mostrar(){
        $this->view->show("administradorView.php", null);
    }

    public function mostrarRegistrar(){
        $this->view->show("administradorRegistrarView.php", null);
    }

    public function mostrarEliminar(){
        require 'model/AdministradorModel.php';
        $admin = new AdministradorModel();
        $data['listaUsuarios'] = $admin->listarUser();
        $this->view->show("administradorEliminarView.php", $data);
    }

    public function mostrarEditar(){
        require 'model/AdministradorModel.php';
        $admin = new AdministradorModel();
        $data['listaUsuarios'] = $admin->listarUser();
        $this->view->show("administradorEditarView.php", $data);
    }

    public function registrarUsuario(){
        require 'model/AdministradorModel.php';
        $admin = new AdministradorModel();
        $data = $admin->registrarUser(
            $_POST['nombre'], $_POST['apellidos'], 
            $_POST['email'], $_POST['pass'], $_POST['admin']
        );
        foreach ($data as $item) {
            echo $item[0];
        }
    }

    public function eliminarUsuario(){
        require 'model/AdministradorModel.php';
        $admin = new AdministradorModel();
        $data = $admin->eliminarUser($_POST['id']);
        foreach ($data as $item) {
            echo $item[0];
        }
    }

    public function editarUsuario(){
        require 'model/AdministradorModel.php';
        $admin = new AdministradorModel();
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $apels = $_POST['apels'];
        $email = $_POST['email'];
        $adm = $_POST['admin'];
        $data = $admin->editUser($id, $nom, $apels, $email, $adm);
        foreach ($data as $item) {
            if($item[0] == 1){
                if($id == $_SESSION['idUserSession']){
                    $_SESSION['nomUserSession'] = $nom;
                    $_SESSION['apelUserSession'] = $apels;
                    $_SESSION['emailUserSession'] = $email;
                    $_SESSION['adminUserSession'] = $adm;
                }
            }
            echo $item[0];
        }
    }

    public function listarUsuario(){
        require 'model/AdministradorModel.php';
        $admin = new AdministradorModel();
        $data = $admin->listarUser();
        $row = $col = "";
        $i = 0;
        foreach ($data as $item) {
            $row = $item[0].",".$item[1].",".$item[2].",".$item[3].",".$item[4];
            if ($i == 0) {
                $col = $row;
            }else{
                $col = $col."|".$row;
            }
            $i++;
        }
        echo $col;
    }

    public function buscarUsuarioById(){
        require 'model/AdministradorModel.php';
        $admin = new AdministradorModel();
        $data = $admin->getUsuarioById($_POST['id']);
        foreach ($data as $item) {
            echo $item[0].'|'.$item[1].'|'.$item[2].'|'.$item[3].'|'.$item[4];
        }
    }
}

?>