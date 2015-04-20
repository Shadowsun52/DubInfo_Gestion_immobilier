<h2>Gestion des sources des maisons</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\business\SourceLocataireCRUD;
    use DubInfo_gestion_immobilier\model\SourceLocataire;
    //formulaire qui permet d'ajouter un locataire
    
    $form_source_locataire = new Zebra_Form('form_sourceLocataire');
    $form_source_locataire->language("francais");
    
    //création de la liste des métiers
    $business = new SourceLocataireCRUD();
    $list_sources[''] = '- Nouveau -';
    foreach ($business->readList() as $source) {
        $list_sources[$source->getId()] = $source->toString();
    }
    
    //liste déroulante avec les investisseurs déjà existant
    $form_source_locataire->add('label','label_id', 'select_id', 'Liste des sources maisons');
    $id = $form_source_locataire->add('select', 'select_id');
    $id->add_options($list_sources ,TRUE);
    
    //on devra afficher les différentes sources de la table "source_formulaire", les éditer, supprimer, ajouter...
    $form_source_locataire->add('label','label_libelle', 'libelle', 'Libellé');
    $libelle = $form_source_locataire->add('text', 'libelle', null, array(
                                    'maxlength' => SourceLocataire::MAX_SIZE_LIBELLE
                                ));
    $libelle->set_rule(array(
               'required' => array('error', 'Libelle requis!'), 
            ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_source_locataire->add('submit', 'btnsubmit', 'Ajouter');
   
    $form_source_locataire->render();

?>
</div>