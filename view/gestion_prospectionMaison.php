<h2>Gestion des prospections de maison</h2>
<div id="formulaire">

<?php
    use DubInfo_gestion_immobilier\model\VisiteMaison;
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    use DubInfo_gestion_immobilier\business\UserCRUD;
    
    //formulaire qui permet de gérer les rencontres avec les investisseurs
    $form_prospection = new Zebra_Form('form_prospectionMaison');
    $form_prospection->language("francais");
    
    $form_prospection->add('label','label_id', 'select_id', 'Liste des prospection');
    $id = $form_prospection->add('select', 'select_id', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $id->add_options(array('' => '- Nouveau -') ,TRUE);
    
    //choix de la maison
    $business_maison = new MaisonCRUD();
    $list_maison[''] = '- Choisissez une maison -';
    foreach ($business_maison->readList() as $maison) {
        $list_maison[$maison->getIdProposition()] = $maison->toString();
    }
    $form_prospection->add('label','label_maison', 'select_maison', 'Maison');
    $maison = $form_prospection->add('select', 'select_maison');
    $maison->add_options($list_maison, true);
    $maison->set_rule(array(
        'required'      =>  array('error', 'Le choix de la maison est requis!')
    ));
    
    //datepicker
    $form_prospection->add('label','label_date_visite', 'date_visite', 'Date de la visite');
    $date = $form_prospection->add('date', 'date_visite');
    $date->set_rule(array(
        'required'      =>  array('error', 'La date est requise!'),
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date->format('d-m-Y');

    //participants
    $business_participant = new UserCRUD();
    foreach ($business_participant->readList() as $participant) {
        $list_participants[$participant->getId()] = $participant->toString();
    }
    $form_prospection->add('label','label_participants', 
            'select_participants', 'Participants');
    $participants = $form_prospection->add('select', 'select_participants',
                                null, array(
                                    'name' => 'select_participants[]',
                                    'multiple' => 'multiple',
                                ));
    $participants->add_options($list_participants,true);
    
    //rapport
    $form_prospection->add('label','label_rapport', 'rapport', 'Rapport');
    $remarque = $form_prospection->add('textarea', 'rapport', null, array(
                                    'maxlength' => VisiteMaison::MAX_SIZE_RAPPORT
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_prospection->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_prospection->render('view/templates/tpl_prospection_maison.php');

?>
</div>
<script type="text/javascript">
    choosenVisiteItemListener("select_maison");
    $('#select_participants').multipleSelect();
</script>
