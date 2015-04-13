<h2>Gestion des sources des locataires</h2>
<div id="formulaire">
<?php
    //formulaire qui permet d'ajouter un locataire
    
    $form_source_locataire = new Zebra_Form('form_source_locataire');
    $form_source_locataire->language("francais");
    
    //champ cacher qui contient l'id de la source où on a trouvé le locataire (immoweb...)
    $id = $form_source_locataire->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    //on devra afficher les différentes sources de la table "source_formulaire", les éditer, supprimer, ajouter...
    $form_source_locataire->add('label','label_libelle', 'libelle', 'Source');
    $nom = $form_source_locataire->add('text', 'nom', null, array(
                                    'maxlength' => 45
                                ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_source_locataire->add('submit', 'btnsubmit', 'Submit');
    
    
    $form_source_locataire->render();

?>
</div>