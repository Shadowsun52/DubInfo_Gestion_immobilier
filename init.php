<?php
    namespace DubInfo_gestion_immobilier;
    
    //chargement du fichier de configuration
    require_once './Config.php';
    //chargement de l'autoloader + demarrage de celui-ci
    require_once './Autoloader.php';
    Autoloader::register();
    
    //ajout des librairies
//    require_once 'phpExcel/PHPExcel.php';
    require_once './librairies/Zebra_Form-2.9.5/Zebra_Form.php';
    