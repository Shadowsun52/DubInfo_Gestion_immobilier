<h2>Gestion des projets</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\Projet;
    use DubInfo_gestion_immobilier\business\InvestisseurCRUD;
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    
    //formulaire qui permet d'ajouter un projet
    
    $form_projet = new Zebra_Form('form_projet');
    $form_projet->language("francais");
    
    $form_projet->add('label','label_id', 'select_id', 'Liste des projets');
    $id = $form_projet->add('select', 'select_id', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $id->add_options(array('' => '- Nouveau -') ,TRUE);
    
    //choix de l'investisseur
    $business_investisseur = new InvestisseurCRUD();
    $list_investisseur[''] = '- Choisissez un investisseur -';
    foreach ($business_investisseur->readList() as $investisseur) {
        $list_investisseur[$investisseur->getId()] = $investisseur->toString();
    }
    $form_projet->add('label','label_investisseur', 'select_investisseur', 'Investisseur');
    $investisseur = $form_projet->add('select', 'select_investisseur');
    $investisseur->add_options($list_investisseur, true);
    $investisseur->set_rule(array(
        'required'      =>  array('error', 'Le choix de l\'investisseur est requis!')
    ));
    
    //choix de la maison
    $business_maison = new MaisonCRUD();
    $list_maison[''] = '- Choisissez une maison -';
    foreach ($business_maison->readList() as $maison) {
        $list_maison[$maison->getIdProposition()] = $maison->toString();
    }
    $form_projet->add('label','label_maison', 'select_maison', 'Maison');
    $maison = $form_projet->add('select', 'select_maison');
    $maison->add_options($list_maison, true);
    $maison->set_rule(array(
        'required'      =>  array('error', 'Le choix de la maison est requis!')
    ));
    
    //date compromis
    $form_projet->add('label','label_date_signature_compromis', 
            'date_signature_compromis', 'Date de la signature du compromis');
    $date_compromis = $form_projet->add('date', 'date_signature_compromis');
    $date_compromis->set_rule(array(
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date_compromis->format('d-m-Y');
    
    //date acte
    $form_projet->add('label','label_date_signature_acte', 'date_signature_acte', 'Date de la signature à l\'acte');
    $date_acte = $form_projet->add('date', 'date_signature_acte');
    $date_acte->set_rule(array(
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date_acte->format('d-m-Y');
    
    $form_projet->add('label','label_plan_metre_fait', 'plan_metre_fait', 'Plan mètre fait');
    $plan_metre = $form_projet->add('radios', 'plan_metre_fait',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    $form_projet->add('label','label_devis_entrepreneur_confirme', 
            'devis_entrepreneur_confirme', 'Devis de l\'entrepreneur confirmé ?');
    $devis_entrepreneur = $form_projet->add('radios', 'devis_entrepreneur_confirme',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    $form_projet->add('label','label_selection_materiaux_fait', 
            'selection_materiaux_fait', 'Sélection des matériaux fait ?');
    $selection_metaux = $form_projet->add('radios', 'selection_materiaux_fait',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    $form_projet->add('label','label_date_reception_chantier', 
            'date_reception_chantier', 'Date de la réception du chantier');
    $date_chantier = $form_projet->add('date', 'date_reception_chantier');
    $date_chantier->set_rule(array(
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date_chantier->format('d-m-Y');
    
    $form_projet->add('label','label_commande_mobilier_fait', 
            'commande_mobilier_fait', 'Commande du mobilier fait ?');
    $commande_mobilier_fait = $form_projet->add('radios', 'commande_mobilier_fait',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    //on va devoir travailler avec un datepicker => date livraison mobilier
    $form_projet->add('label','label_date_livraison_mobilier', 
            'date_livraison_mobilier', 'Date de la livraison du mobilier');
    $date_mobilier = $form_projet->add('date', 'date_livraison_mobilier');
    $date_mobilier->set_rule(array(
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date_mobilier->format('d-m-Y');
    
    $form_projet->add('label','label_etat', 'select_etat', 'Etat');
    $etat = $form_projet->add('select', 'select_etat');
    $etat->add_options(array( 
    '' => '- Choisissez un etat -',
    '2' => 'Actif',
    '11' => 'Terminé',
    '3' => 'Abandonné'
    ),true);
    
    //remarque
    $form_projet->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_projet->add('textarea', 'remarque', null, array(
                                    'maxlength' => Projet::MAX_SIZE_COMMENTAIRE
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_projet->add('submit', 'btnsubmit', 'Submit');
    
    $form_projet->render('view/templates/tpl_projet.php');

?>
</div>
<script type="text/javascript">
    choosenVisiteItemListener("select_investisseur");
</script>