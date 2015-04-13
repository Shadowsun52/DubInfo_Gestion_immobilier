<?php
namespace DubInfo_gestion_immobilier\ajax;

use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;

require './init.php';
if(isset($_POST['name_form_investisseur'])) {
    //création de l'objet Investisseur, utilisé dans le reste de l'app
    try {
        $ville = new Ville(null, $_POST['select_cp'], $_POST['select_villes'], $_POST['select_pays']);
        $adresse = new Adresse($_POST['rue'], $_POST['numero'], $ville);
        $investisseur = new Investisseur(null, $_POST['nom'], $_POST['prenom'], 
            $_POST['num_telephone'], $_POST['num_gsm'], $_POST['mail'], 
            $adresse, null, $_POST['num_tva'], $_POST['remarque']);//la valeur null de la ligne sera pour l'état pas encore géré
        echo json_encode(array('success' => true, 'message' => "L'investisseur a été ajouté avec succès"));
    } catch (Exception $ex) {
        echo json_encode(array('success' => false, 'erreur' => $ex->getMessage()));
    }
}
else 
{
    echo json_encode(array('success' => false, 'erreur' => "Le formulaire n'a pas été envoyé"));
}
?>