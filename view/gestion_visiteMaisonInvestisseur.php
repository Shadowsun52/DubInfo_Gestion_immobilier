<h2>Gestion des visites de maison par un investisseur</h2>
<div id="formulaire">

<?php
    use DubInfo_gestion_immobilier\model\VisiteMaisonInvestisseur;
    use DubInfo_gestion_immobilier\business\InvestisseurCRUD;
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    use DubInfo_gestion_immobilier\business\UserCRUD;
    
    //formulaire qui permet de gérer les rencontres avec les investisseurs
    $form_visite_maison_invest = new Zebra_Form('form_visiteMaisonInvestisseur');
    $form_visite_maison_invest->language("francais");
    
    $form_visite_maison_invest->add('label','label_id', 'select_id', 'Liste des visites');
    $id = $form_visite_maison_invest->add('select', 'select_id', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $id->add_options(array('' => '- Nouveau -') ,TRUE);
    
    //choix de l'investisseur
    $business_investisseur = new InvestisseurCRUD();
    $list_investisseur[''] = '- Choisissez un investisseur -';
    foreach ($business_investisseur->readList() as $investisseur) {
        $list_investisseur[$investisseur->getId()] = $investisseur->toString();
    }
    $form_visite_maison_invest->add('label','label_investisseur', 'select_investisseur', 'Investisseur');
    $investisseur = $form_visite_maison_invest->add('select', 'select_investisseur');
    $investisseur->add_options($list_investisseur, true);
    $investisseur->set_rule(array(
        'required'      =>  array('error', 'Le choix de l\'investisseur est requis!')
    ));
    
    //datepicker
    $form_visite_maison_invest->add('label','label_date_visite', 'date_visite', 'Date de la visite');
    $date = $form_visite_maison_invest->add('date', 'date_visite');
    $date->set_rule(array(
        'required'      =>  array('error', 'La date est requise!'),
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date->format('d-m-Y');

    //choix de la maison
    $business_maison = new MaisonCRUD();
    $list_maison[''] = '- Choisissez une maison -';
    foreach ($business_maison->readList() as $maison) {
        $list_maison[$maison->getIdProposition()] = $maison->toString();
    }
    $form_visite_maison_invest->add('label','label_maison', 'select_maison', 'Maison');
    $maison = $form_visite_maison_invest->add('select', 'select_maison');
    $maison->add_options($list_maison, true);
    $maison->set_rule(array(
        'required'      =>  array('error', 'Le choix de la maison est requis!')
    ));
    
    //participants
    $business_participant = new UserCRUD();
    foreach ($business_participant->readList() as $participant) {
        $list_participants[$participant->getId()] = $participant->toString();
    }
    $form_visite_maison_invest->add('label','label_participants', 
            'select_participants', 'Participants');
    $participants = $form_visite_maison_invest->add('select', 'select_participants',
                                null, array(
                                    'name' => 'select_participants[]',
                                    'multiple' => 'multiple',
                                ));
    $participants->add_options($list_participants,true);
    
    //rapport
    $form_visite_maison_invest->add('label','label_rapport', 'rapport', 'Rapport');
    $remarque = $form_visite_maison_invest->add('textarea', 'rapport', null, array(
                                    'maxlength' => VisiteMaisonInvestisseur::MAX_SIZE_RAPPORT
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_visite_maison_invest->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_visite_maison_invest->render('view/templates/tpl_visite_maison_invest.php');

?>
</div>
<script type="text/javascript">
    choosenVisiteItemListener("select_investisseur");
    $('#select_participants').multipleSelect();
</script>
