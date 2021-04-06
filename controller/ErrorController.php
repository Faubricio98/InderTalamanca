<?php

class ErrorController{

    public function __construct() {
        $this->view = new View();
    } // constructor

    public function error($code, $name, $msg){
        $respuesta['mensaje'] = array($code, $name, $msg);
        $this->view->show("errorView.php", $respuesta);
    }
}

?>