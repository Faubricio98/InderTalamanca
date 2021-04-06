<?php

class OficioModel{

    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::singleton();
    } // constructor

    public function guardarNuevoOficio($remit_of, $desti_of, $asunt_of){
        $consulta= $this->db->prepare("call sp_create_new_oficio('".$remit_of."', '".$desti_of."', '".$asunt_of."')");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function listarOficios(){
        $consulta= $this->db->prepare("call sp_get_all_oficio()");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
}

?>