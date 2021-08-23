<?php

class OficioController{

    public function __construct() {
        $this->view = new View();
    } // constructor

    public function mostrar(){
        $this->view->show("oficioView.php", null);
    }

    public function mostrarRegistro(){
        $this->view->show("oficioRegistroView.php", null);
    }

    public function mostrarUpload(){
        require 'model/OficioModel.php';
        $oficios = new OficioModel();
        $data['listaOficio'] = $oficios->listarOficios();
        $data['fileList'] = $oficios->listarDocumentosOficios();
        
        //$mydir = 'uploads/';
        //$data['fileList'] = array_diff(scandir($mydir), array('.', '..'));
        //print_r($myfiles);

        $_SESSION['uploadSession'] = 0;
        $this->view->show("oficioUploadView.php", $data);
    }

    public function listar(){
        require 'model/OficioModel.php';
        $oficios = new OficioModel();
        $data['listaOficio'] = $oficios->listarOficios();
        $this->view->show("oficioListarView.php", $data);
    }

    public function crearNuevoOficio(){
        require 'model/OficioModel.php';
        $oficio = new OficioModel();
        $data = $oficio->guardarNuevoOficio($_POST['remit_of'], $_POST['desti_of'], $_POST['asunt_of']);
        foreach ($data as $item) {
            echo $item[0];
        }
    }

    public function uploadFile(){
        require 'model/OficioModel.php';
        $oficios = new OficioModel();

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $_SESSION['uploadSession'] = 0;
        $documentFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow certain file formats
        if($documentFileType != "doc" && $documentFileType != "docx" && $documentFileType != "pdf") {
            $_SESSION['uploadSession'] = -1;
        }

        // Check if $uploadOk is set to 0 by an error
        if($_SESSION['uploadSession'] == 0){
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //guardamos el registro en bd
                $_SESSION['uploadSession'] = $oficios->guardarNuevoDocumentoOficio($_POST["selectIdOficio"], basename($_FILES["fileToUpload"]["name"]));
            } else {
                $_SESSION['uploadSession'] = -2;
            } 
        }

        //$mydir = 'uploads/';
        //$data['fileList'] = array_diff(scandir($mydir), array('.', '..'));
        $data['listaOficio'] = $oficios->listarOficios();
        $data['fileList'] = $oficios->listarDocumentosOficios();
        $this->view->show("oficioUploadView.php", $data);
    }
}

?>