<?php
    require 'libs/Config.php';
    $config= Config::singleton();
    $config->set('controllerFolder','controller/');
    $config->set('modelFolder', 'model/');
    $config->set('viewFolder', 'view/');
    
    $config->set('dbhost', '127.0.0.1'); // ip
    $config->set('dbname', 'b61976_tcu_inder_talamanca');
    $config->set('dbuser', 'fauch');
    $config->set('dbpass', 'fauch');

    //$config->set('dbhost', '163.178.107.10'); // ip
    //$config->set('dbname', 'b61976_tcu_inder_talamanca');
    //$config->set('dbuser', 'laboratorios');
    //$config->set('dbpass', 'KmZpo.2796');
?>

