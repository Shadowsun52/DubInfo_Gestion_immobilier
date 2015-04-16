<h2>Gestion des métiers</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\Metier;
    use DubInfo_gestion_immobilier\business\BusinessCRUD;
    //formulaire qui gère les différents métiers (professionnels)
    
    $form_metier = new Zebra_Form('form_metier');
    $form_metier->language("francais");
    
    //création de la liste des métiers
    $business = new BusinessCRUD();
    $list_metiers[''] = '- Nouveau -';
    foreach ($business->readListMetier() as $metier) {
        $list_metiers[$metier->getId()] = $metier->getLibelle();
    }
    
    //liste déroulante avec les investisseurs déjà existant
    $form_metier->add('label','label_id', 'select_id', 'Liste des Métiers');
    $id = $form_metier->add('select', 'select_id');
    $id->add_options($list_metiers ,TRUE);
    
    //on devra afficher les différentes sources de la table "source_formulaire", les éditer, supprimer, ajouter...
    $form_metier->add('label','label_libelle', 'libelle', 'Libelle');
    $libelle = $form_metier->add('text', 'libelle', null, array(
                                    'maxlength' => Metier::MAX_SIZE_LIBELLE
                                ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_metier->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_metier->render();

?>
</div>