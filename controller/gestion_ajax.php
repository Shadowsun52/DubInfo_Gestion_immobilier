<?php
namespace DubInfo_gestion_immobilier\controller;
use DubInfo_gestion_immobilier\business\BusinessCRUD;
require './init.php';
/**
 * action représente l'action désirer c'est à dire soit 'add' ou 'edit'
 * item est l'objet cible de l'action
 */
if(isset($_POST['action']) && isset($_POST['item'])) {
    try {
        $name_business = "BusinessCRUD";
        $business = new $name_business();
        //appel de la méthode d'ajout de manière dynamique
        $name_function = $_POST['action'] . ucfirst(strtolower($_POST['item']));
        $return = $business->$name_function($_POST);
        echo json_encode($return);
    } catch (Exception $exc) {
        echo json_encode(array('success' => false, 'erreur' => $ex->getMessage()));
    }

}
else 
{
    echo json_encode(array('success' => false, 'erreur' => "Le formulaire n'a pas été envoyé correctement!"));
}
?>