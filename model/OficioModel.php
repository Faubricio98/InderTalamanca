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

    public function listarDocumentosOficios(){
        $consulta= $this->db->prepare("call sp_get_all_documento_oficio()");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function guardarNuevoDocumentoOficio($num_of, $nom_doc){
        $consulta= $this->db->prepare("call sp_add_new_documento_oficio('".$num_of."', '".$nom_doc."')");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        foreach($resultado as $item){
            return $item[1];
        }
        //return $resultado;
    }
}

?>