<?php
    use DubInfo_gestion_immobilier\Autoloader;
    //chargement du fichier de configuration
    require_once '../Config.php';
    //chargement de l'autoloader + demarrage de celui-ci
    require_once '../Autoloader.php';
    Autoloader::register();

    require_once '../librairies/phpExcel/PHPExcel.php';