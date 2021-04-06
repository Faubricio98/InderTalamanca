<?php

class IndexController {
    public function __construct() {
        $this->view = new View();
    } // constructor
    
    public function mostrar(){
        $_SESSION['idUserSession'] = -1;
        $this->view->show("indexView.php", null);
    } // listar
}

?>