<h2>Gestion des rencontres avec les investisseurs</h2>
<div id="formulaire">

<?php
    use DubInfo_gestion_immobilier\model\VisiteInvestisseur;
    use DubInfo_gestion_immobilier\business\InvestisseurCRUD;
    
    define('SIZE_LIST_PARTICIPANT', 5);
    //formulaire qui permet de gérer les rencontres avec les investisseurs
    $form_rencontre_investisseur = new Zebra_Form('form_rencontreInvestisseur');
    $form_rencontre_investisseur->language("francais");
    
    $form_rencontre_investisseur->add('label','label_id', 'select_id', 'Liste des rencontres');
    $id = $form_rencontre_investisseur->add('select', 'select_id', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $id->add_options(array('' => '- Nouveau -') ,TRUE);
    
    //choix de l'investisseur
    $business_investisseur = new InvestisseurCRUD();
    $list_investisseur[''] = '- Choisissez un investisseur -';
    foreach ($business_investisseur->readList() as $investisseur) {
        $list_investisseur[$investisseur->getId()] = $investisseur->toString();
    }
    $form_rencontre_investisseur->add('label','label_investisseur', 'select_investisseur', 'Investisseur');
    $investisseur = $form_rencontre_investisseur->add('select', 'select_investisseur');
    $investisseur->add_options($list_investisseur, true);
    $investisseur->set_rule(array(
        'required'      =>  array('error', 'Le choix de l\'investisseur est requis!')
    ));
    
    //datepicker
    $form_rencontre_investisseur->add('label','label_date_rencontre', 'date_rencontre', 'Date de la recontre');
    $date = $form_rencontre_investisseur->add('date', 'date_rencontre');
    $date->set_rule(array(
        'required'      =>  array('error', 'La date est requise!'),
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date->format('d-m-Y');
    
    $form_rencontre_investisseur->add('label','label_endroit', 'endroit', 'Endroit');
    $nom = $form_rencontre_investisseur->add('text', 'endroit', null, array(
                                    'maxlength' => VisiteInvestisseur::MAX_SIZE_ENDROIT,
                                ));

    //participants
//    $business_investisseur = new InvestisseurCRUD();
//    foreach ($business_investisseur->readList() as $investisseur) {
//        $list_participants[$investisseur->getId()] = $investisseur->toString();
//    }
    $form_rencontre_investisseur->add('label','label_participants', 
            'select_participants', 'Participants');
    $communes = $form_rencontre_investisseur->add('select', 'select_participants',
                                null, array(
                                    'name' => 'select_participants[]',
                                    'multiple' => 'multiple',
                                    'size' => SIZE_LIST_PARTICIPANT
                                ));
    $communes->add_options(array(),false);
    
    //rapport
    $form_rencontre_investisseur->add('label','label_rapport', 'rapport', 'Rapport');
    $remarque = $form_rencontre_investisseur->add('textarea', 'rapport', null, array(
                                    'maxlength' => VisiteInvestisseur::MAX_SIZE_RAPPORT
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_rencontre_investisseur->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_rencontre_investisseur->render('view/templates/tpl_rencontre_investisseur.php');

?>
</div>
<script type="text/javascript">
    choosenVisiteItemListener("select_investisseur");
    $('#select_participants').multipleSelect();
</script>