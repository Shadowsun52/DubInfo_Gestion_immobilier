<?php
    namespace DubInfo_gestion_immobilier\controller;
    use DubInfo_gestion_immobilier\excel\DocumentExcel;
//    use Exception;
//    use DubInfo_gestion_immobilier\Exception\ClassNotFoundException;
    require './init.php';
    
    if(isset($_POST['item']) && isset($_POST['data'])) {
        try {
            $data = json_decode($_POST['data']);
            $excel= new DocumentExcel($_POST['item'], $data);
            $excel->generateDocument();
            echo json_encode(array(
                'success' => true, 
                'link' => $excel->getLink()));
        } catch (Exception $ex) {
            echo json_encode(array(
                'success' => false, 
                'erreur' => "Une erreur a été rencontré!"));
        }
        
    }
    else {
        echo json_encode(array(
        'success' => false, 
        'erreur' => "Il manque des données pour générer le fichier excel!"));
    }
?>

