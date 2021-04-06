<?php

class View {
    public function __construct() {
        ;
    } // constructor
    
    public function show($nombreVista, $vars=array()){
        $config= Config::singleton();
        $path=$config->get('viewFolder').$nombreVista;
        
        if(is_file($path)==FALSE){
            require 'controller/ErrorController.php';
            $error = new ErrorController();
            die($error->error(404, 'Not found', 'Ruta de la vista '.$nombreVista.' no encontrada'));
            return FALSE;
        }
        
        if(is_array($vars)){
            foreach($vars as $key=>$value){
                $key=$value;
            }
        }
        
        include $path;
    }
}