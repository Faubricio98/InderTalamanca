<?php

class UsuarioController{

    public function __construct() {
        $this->view = new View();
    } // constructor

    public function mostrar(){
        $this->view->show("usuarioView.php", null);
    }

    public function logUsuarioIn(){
        
        //llamada al model
        require 'model/UsuarioModel.php';
        $usuario = new UsuarioModel();
        $data=$usuario->log($_POST['user_name'], $_POST['user_pass']);
        foreach ($data as $item) {
            if ($item[0] != 0) {
                $_SESSION['idUserSession'] = $item[0];
                $dataU=$usuario->setSessionDataUser($_SESSION['idUserSession']);
                $_SESSION['nomUserSession'] = $dataU[0][1];
                $_SESSION['apelUserSession'] = $dataU[0][2];
                $_SESSION['emailUserSession'] = $dataU[0][3];
                $_SESSION['adminUserSession'] = $dataU[0][4];
            }
            echo $item[0];
        }
    }

    public function logUsuarioOut(){
        unset($_SESSION['idUserSession']);
        unset($_SESSION['nomUserSession']);
        unset($_SESSION['apelUserSession']);
        unset($_SESSION['emailUserSession']);
        unset($_SESSION['adminUserSession']);
        session_destroy();
        $this->view->show("indexView.php", null);
    }

}

?>