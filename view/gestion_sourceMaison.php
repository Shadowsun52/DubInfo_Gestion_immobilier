<h2>Gestion des sources des maisons</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\business\SourceMaisonCRUD;
    use DubInfo_gestion_immobilier\model\SourceMaison;
    //formulaire qui permet d'ajouter un locataire
    
    $form_source_maison = new Zebra_Form('form_sourceMaison');
    $form_source_maison->language("francais");
    
    //création de la liste des métiers
    $business = new SourceMaisonCRUD();
    $list_sources[''] = '- Nouveau -';
    foreach ($business->readList() as $source) {
        $list_sources[$source->getId()] = $source->toString();
    }
    
    //liste déroulante avec les investisseurs déjà existant
    $form_source_maison->add('label','label_id', 'select_id', 'Liste des sources maisons');
    $id = $form_source_maison->add('select', 'select_id');
    $id->add_options($list_sources ,TRUE);
    
    //on devra afficher les différentes sources de la table "source_formulaire", les éditer, supprimer, ajouter...
    $form_source_maison->add('label','label_libelle', 'libelle', 'Libellé');
    $libelle = $form_source_maison->add('text', 'libelle', null, array(
                                    'maxlength' => SourceMaison::MAX_SIZE_LIBELLE
                                ));
    $libelle->set_rule(array(
               'required' => array('error', 'Libelle requis!'), 
            ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_source_maison->add('submit', 'btnsubmit', 'Ajouter');
   
    $form_source_maison->render();

?>
</div>