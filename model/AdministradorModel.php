<?php

class AdministradorModel{

    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::singleton();
    } // constructor

    public function registrarUser($nom, $apels, $email, $pass, $admin){
        $consulta= $this->db->prepare("call sp_create_new_usuario('".$nom."', '".$apels."', '".$email."', '".$pass."', ".$admin.")");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function listarUser(){
        $consulta= $this->db->prepare("call sp_get_all_usuario()");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function eliminarUser($id){
        $consulta= $this->db->prepare("call sp_delete_usuario_by_id(".$id.")");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function getUsuarioById($id_user){
        $consulta= $this->db->prepare("call sp_get_usuario_by_id(".$id_user.")");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function editUser($id, $nom, $apels, $email, $admin){
        $consulta= $this->db->prepare("call sp_edit_usuario_by_id(".$id.", '".$nom."', '".$apels."', '".$email."', ".$admin.")");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
}

?>