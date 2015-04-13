<h2>Gestion des métiers</h2>
<div id="formulaire">
<?php
    //formulaire qui gère les différents métiers (professionnels)
    
    $form_metier = new Zebra_Form('form_metier');
    $form_metier->language("francais");
    
    //champ cacher qui contient l'id du métier
    $id = $form_metier->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    //on devra afficher les différentes sources de la table "source_formulaire", les éditer, supprimer, ajouter...
    $form_metier->add('label','label_libelle', 'libelle', 'Source');
    $nom = $form_metier->add('text', 'nom', null, array(
                                    'maxlength' => 45
                                ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_metier->add('submit', 'btnsubmit', 'Submit');
    
    $form_metier->render();

?>
</div>