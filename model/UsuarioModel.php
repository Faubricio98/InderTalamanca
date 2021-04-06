<?php

class UsuarioModel{

    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::singleton();
    } // constructor

    public function log($user_name, $user_pass){
        $consulta= $this->db->prepare("call sp_login_usuario('".$user_name."', '".$user_pass."')");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function setSessionDataUser($id_user){
        $consulta= $this->db->prepare("call sp_get_usuario_by_id(".$id_user.")");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
}

?>