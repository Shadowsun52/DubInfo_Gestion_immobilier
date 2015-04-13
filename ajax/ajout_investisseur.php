<?php
namespace DubInfo_gestion_immobilier\ajax;

use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Etat;

require './init.php';
if(isset($_data['name_form_investisseur'])) {
    //création de l'objet Investisseur, utilisé dans le reste de l'app
    try {
        $ville = new Ville(null, $_data['select_cp'], $_data['select_villes'], $_data['select_pays']);
        $adresse = new Adresse($_data['rue'], $_data['numero'], $ville);
        $etat = new Etat(1); //temporaire pour tester
//        $etat = new Etat($_POST['select_etat'])// la vrai ligne à mettre quand la DB et le reste sera opérationnel     
        $investisseur = new Investisseur(null, $_data['nom'], $_data['prenom'], 
            $_data['num_tel'], $_data['num_gsm'], $_data['mail'], 
            $adresse, $etat, $_data['num_tva'], $_data['remarque']);
        var_dump($investisseur);
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