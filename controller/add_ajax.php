<?php
namespace DubInfo_gestion_immobilier\controller;
use DubInfo_gestion_immobilier\business\BusinessCRUD;
require './init.php';
if(isset($_POST['item'])) {
    try {
        $business = new BusinessCRUD();
        //appel de la méthode d'ajout de manière dynamique
        $name_function = 'add' . ucfirst(strtolower($_POST['item']));
        $message = $business->$name_function($_POST);
        echo json_encode(array('success' => true, 'message' => $message));
    } catch (Exception $exc) {
        echo json_encode(array('success' => false, 'erreur' => $ex->getMessage()));
    }

}
else 
{
    echo json_encode(array('success' => false, 'erreur' => "Le formulaire n'a pas été envoyé"));
}
?>