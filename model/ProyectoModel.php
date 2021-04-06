<?php

class ProyectoModel{

    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::singleton();
    } // constructor

    public function guardarNuevoProyecto($oficio, $nombre, $actividad, $tipo, $beneficiario, $inversion){
        $consulta= $this->db->prepare("call sp_create_new_proyecto('".$oficio."', '".$nombre."', '".$actividad."', '".$tipo."', '".$beneficiario."', ".$inversion.")");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function listarProyectos(){
        $consulta= $this->db->prepare("call sp_get_all_proyecto()");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function getProyectoById($id){
        $consulta= $this->db->prepare("call sp_get_proyecto_by_id('".$id."')");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function actualizar($num_p, $num_o, $nom_p, $act_p, $tip_a, $ben_p, $inv_p, $res_p, $inf_c){
        $consulta= $this->db->prepare("call sp_create_new_avance_proyecto('".$num_p."', '".$num_o."', '".$nom_p."', '".$act_p."', '".$tip_a."', '".$ben_p."', ".$inv_p.", ".$res_p.", '".$inf_c."')");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function lineaTiempo($num_p){
        $consulta= $this->db->prepare("call sp_get_avance_proyecto_by_id('".$num_p."')");
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
}