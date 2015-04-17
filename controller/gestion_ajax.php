<?php
namespace DubInfo_gestion_immobilier\controller;
use Exception;
use DubInfo_gestion_immobilier\Exception\ClassNotFoundException;
require './init.php';
use DubInfo_gestion_immobilier\business\ProfessionnelCRUD;
define('DEFAULT_NAMESPACE', 'DubInfo_gestion_immobilier\business\\');
/**
 * action représente l'action désirer c'est à dire soit 'add' ou 'edit'
 * item est l'objet cible de l'action
 */
if(isset($_POST['action']) && isset($_POST['item'])) {
    try {
        $name_business = DEFAULT_NAMESPACE. ucfirst(strtolower($_POST['item'])) . "CRUD";
        $business = new $name_business();
        $name_function = $_POST['action'];
        if(method_exists($business, $name_function)) {
            $return = $business->$name_function($_POST);
            echo json_encode($return);
        }
        else {
            echo json_encode(array(
            'success' => false, 
            'erreur' => "L'action demandée n'est pas définie dans le code!"));
        }
    } catch (ClassNotFoundException $ex) {
        echo json_encode(array(
                'success' => false, 
                'erreur' => "La classe lié à l'item n'a pas été trouvée dans le code!"));
    } catch (Exception $ex) {
        echo json_encode(array('success' => false, 'erreur' => $ex->getMessage()));
    }

}
else 
{
    echo json_encode(array(
        'success' => false, 
        'erreur' => "Le formulaire n'a pas été envoyé correctement!"));
}
?>