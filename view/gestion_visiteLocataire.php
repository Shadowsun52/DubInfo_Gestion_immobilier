<h2>Gestion des visites de maison par un locataire</h2>
<div id="formulaire">

<?php
    use DubInfo_gestion_immobilier\model\VisiteLocataire;
    use DubInfo_gestion_immobilier\business\LocataireCRUD;
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    use DubInfo_gestion_immobilier\business\UserCRUD;
    
    define("ETAT_LOCATION", 7);
    define("ETAT_PROJET", 10);
    $etatAtShow = [ETAT_LOCATION, ETAT_PROJET];
    //formulaire qui permet de gérer les rencontres avec les investisseurs
    $form_visite_locataire = new Zebra_Form('form_visiteLocataire');
    $form_visite_locataire->language("francais");
    
    $form_visite_locataire->add('label','label_id', 'select_id', 'Liste des visites');
    $id = $form_visite_locataire->add('select', 'select_id', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $id->add_options(array('' => '- Nouveau -') ,TRUE);
    
    //choix du locataire
    $business_locataire = new LocataireCRUD();
    $list_locataire[''] = '- Choisissez un locataire -';
    foreach ($business_locataire->readList() as $locataire) {
        $list_locataire[$locataire->getId()] = $locataire->toString();
    }
    $form_visite_locataire->add('label','label_locataire', 'select_locataire', 'Locataire');
    $investisseur = $form_visite_locataire->add('select', 'select_locataire');
    $investisseur->add_options($list_locataire, true);
    $investisseur->set_rule(array(
        'required'      =>  array('error', 'Le choix de l\'investisseur est requis!')
    ));
    
    //datepicker
    $form_visite_locataire->add('label','label_date_visite', 'date_visite', 'Date de la visite');
    $date = $form_visite_locataire->add('date', 'date_visite');
    $date->set_rule(array(
        'required'      =>  array('error', 'La date est requise!'),
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date->format('d-m-Y');

    //choix de la maison
    $business_maison = new MaisonCRUD();
    $list_maison[''] = '- Choisissez une maison -';
    foreach ($business_maison->readList() as $maison) {
        if(in_array($maison->getEtat()->getId(), $etatAtShow)) {
            $list_maison[$maison->getIdProposition()] = $maison->toString();
        }
    }
    $form_visite_locataire->add('label','label_maison', 'select_maison', 'Maison');
    $maison = $form_visite_locataire->add('select', 'select_maison');
    $maison->add_options($list_maison, true);
    $maison->set_rule(array(
        'required'      =>  array('error', 'Le choix de la maison est requis!')
    ));
    
    //participants
    $business_participant = new UserCRUD();
    foreach ($business_participant->readList() as $participant) {
        $list_participants[$participant->getId()] = $participant->toString();
    }
    $form_visite_locataire->add('label','label_participants', 
            'select_participants', 'Participants');
    $participants = $form_visite_locataire->add('select', 'select_participants',
                                null, array(
                                    'name' => 'select_participants[]',
                                    'multiple' => 'multiple',
                                ));
    $participants->add_options($list_participants,true);
    
    //rapport
    $form_visite_locataire->add('label','label_candidat', 'candidat', 'le locataire est candidat :');
    $candidat = $form_visite_locataire->add('checkboxes', 'candidat', array('Oui'));
    
    //rapport
    $form_visite_locataire->add('label','label_rapport', 'rapport', 'Rapport');
    $remarque = $form_visite_locataire->add('textarea', 'rapport', null, array(
                                    'maxlength' => VisiteLocataire::MAX_SIZE_RAPPORT
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_visite_locataire->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_visite_locataire->render('view/templates/tpl_visite_locataire.php');

?>
</div>
<script type="text/javascript">
    choosenVisiteItemListener("select_locataire");
    $('#select_participants').multipleSelect();
</script>
