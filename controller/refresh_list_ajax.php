<?php
namespace DubInfo_gestion_immobilier\controller;
use DubInfo_gestion_immobilier\business\BusinessCRUD;
require './init.php';
/**
 * action représente l'action désirer c'est à dire soit 'add' ou 'edit'
 * item est l'objet cible de l'action
 */
if(isset($_POST['item'])) {
    try {
        $business = new BusinessCRUD();
        //appel de la méthode d'ajout de manière dynamique
        $name_function = 'readList' . ucfirst(strtolower($_POST['item']));
        $return = $business->$name_function();
        echo json_encode($return);
    } catch (Exception $exc) {
        echo json_encode(array('error' => true, 'erreur' => $ex->getMessage()));
    }

}
else 
{
    echo json_encode(array('error' => true, 'erreur' => "Le type du formulaire n'a pas été reçu!"));
}