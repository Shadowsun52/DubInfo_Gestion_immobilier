<h2>Gestion des communes</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\Commune;
//    use DubInfo_gestion_immobilier\business\MetierCRUD;
    
    $form_commune = new Zebra_Form('form_commune');
    $form_commune->language("francais");
    
    //création de la liste des métiers
//    $business = new MetierCRUD();
    $list_communes[''] = '- Nouveau -';
//    foreach ($business->readList() as $metier) {
//        $list_communes[$metier->getId()] = $metier->toString();
//    }
    
    //liste déroulante avec les investisseurs déjà existant
    $form_commune->add('label','label_id', 'select_id', 'Liste des communes');
    $id = $form_commune->add('select', 'select_id');
    $id->add_options($list_communes ,TRUE);
    
    //on devra afficher les différentes sources de la table "source_formulaire", les éditer, supprimer, ajouter...
    $form_commune->add('label','label_libelle', 'libelle', 'Libellé');
    $libelle = $form_commune->add('text', 'libelle', null, array(
                                    'maxlength' => Commune::MAX_SIZE_LIBELLE
                                ));
    
    $libelle->set_rule(array(
               'required' => array('error', 'Libelle requis!'), 
            ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_commune->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_commune->render();

?>
</div>
