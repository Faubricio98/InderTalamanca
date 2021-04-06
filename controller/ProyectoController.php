<?php

class ProyectoController{

    public function __construct() {
        $this->view = new View();
    } // constructor

    public function mostrar(){
        $this->view->show("proyectoView.php", null);
    }

    public function mostrarRegistro(){
        require 'model/OficioModel.php';
        $oficios = new OficioModel();
        $data['listaOficio'] = $oficios->listarOficios();
        $this->view->show("proyectoRegistrarView.php", $data);
    }

    public function mostrarActualizar(){
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();
        $data['listaProyecto'] = $proyectos->listarProyectos();
        $this->view->show("proyectoActualizarView.php", $data);
    }

    public function mostrarListar(){
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();
        $data['listaProyecto'] = $proyectos->listarProyectos();
        $this->view->show("proyectoListarView.php", $data);
    }

    public function mostrarLineaTiempo(){
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();
        $data['listaAvances'] = $proyectos->lineaTiempo($_SESSION['numProySession']);
        $this->view->show("proyectoLineaTiempoView.php", $data);
    }

    public function crearNuevoProyecto(){
        require 'model/ProyectoModel.php';
        $proyecto = new ProyectoModel();
        $data = $proyecto->guardarNuevoProyecto($_POST['oficio'], $_POST['nombre'], $_POST['actividad'], $_POST['tipo'], $_POST['beneficiario'], $_POST['inversion']);
        foreach ($data as $item) {
            echo $item[0];
        }
    }

    public function buscarProyecto(){
        require 'model/ProyectoModel.php';
        $proyecto = new ProyectoModel();
        $data = $proyecto->getProyectoById($_POST['num_proyecto']);
        foreach ($data as $item) {
            echo $item[0].'|'.$item[1].'|'.$item[2].'|'.$item[3].'|'.$item[4].'|'.$item[5].'|'.$item[6].'|'.$item[7].'|'.$item[8];
        }
    }

    public function agregarAvanceProyecto(){
        require 'model/ProyectoModel.php';
        $avance = new ProyectoModel();
        $data = $avance->actualizar(
            $_POST['num_p'], $_POST['num_o'], $_POST['nom_p'], 
                $_POST['act_p'], $_POST['tip_a'], $_POST['ben_p'], 
                    $_POST['inv_p'], $_POST['res_p'], $_POST['inf_c']);
        
        foreach ($data as $item) {
            echo $item[0];
        }
    }

    public function saveNumProyecto(){
        $_SESSION['numProySession'] = $_POST['num_p'];
    }
}

?>