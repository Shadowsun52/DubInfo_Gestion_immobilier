<h2>Gestion des états des locataires</h2>
<div id="formulaire">
<?php
    //formulaire qui gère les différents états locataires
    
    $form_etat_locataire = new Zebra_Form('form_etat_locataire');
    $form_etat_locataire->language("francais");
    
    //champ cacher qui contient l'id de la source où on a trouvé le locataire (immoweb...)
    $id = $form_etat_locataire->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    //on devra afficher les différentes sources de la table "source_formulaire", les éditer, supprimer, ajouter...
    $etat_locataire = $form_etat_locataire->add('select', 'sel_etat_locataire');
    $etat_locataire->add_options(array(
    //ceci ne fonctionne pas (choisissez un pays)    
    
    ));
                                
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_etat_locataire->add('submit', 'btnsubmit', 'Submit');
    
    $form_etat_locataire->render('view/templates/tpl_etatLocataire.php');

?>

</div>