<h2>Gestion des loyers</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\business\LocataireCRUD;
    use DubInfo_gestion_immobilier\model\Paiement;
    //formulaire qui permet de gérer le paiement des loyers
    define('MIN_YEAR', 2013);
    
    $form_paiement_loyer = new Zebra_Form('form_paiementLoyer');
    $form_paiement_loyer->language("francais");
    
    //choix du locataire
    $business_locataire = new LocataireCRUD();
    $list_locataire[''] = '- Choisissez un locataire -';
    foreach ($business_locataire->readList() as $locataire) {
        $list_locataire[$locataire->getId()] = $locataire->toString();
    }
    $form_paiement_loyer->add('label','label_locataire', 'select_locataire', 'Locataire');
    $locataire = $form_paiement_loyer->add('select', 'select_locataire');
    $locataire->add_options($list_locataire, true);
    $locataire->set_rule(array(
        'required'      =>  array('error', 'Le choix du locataire est requis!')
    ));
    
    $form_paiement_loyer->add('label','label_location', 'select_location', 'Location');
    $location = $form_paiement_loyer->add('select', 'select_location', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $location->add_options(array('' => '- Choisissez une location -'), true);
    $location->set_rule(array(
        'required'      =>  array('error', 'Le choix de la location est requis!')
    ));
    
    $form_paiement_loyer->add('label','label_id', 'select_id', 'Liste des paiements');
    $id = $form_paiement_loyer->add('select', 'select_id', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $id->add_options(array('' => '- Nouveau -') ,TRUE);
    
    $list_mois[''] = '- Choisissez un mois -';
    $list_mois = array_merge($list_mois, Paiement::getNomsMois());
    $form_paiement_loyer->add('label','label_sel_mois', 'select_mois', 'Mois');
    $mois = $form_paiement_loyer->add('select', 'select_mois');
    $mois->add_options($list_mois, true);
    $mois->set_rule(array(
        'required' => array('error', 'Le choix du mois est requis!')
    ));
    
    $list_years[''] = '- Choisissez une année -';
    for ($year = MIN_YEAR; $year <= (date('Y')+1); $year++) {
        $list_years[$year] = $year;
    }
    $form_paiement_loyer->add('label','label_sel_annee', 'select_annee', 'Année');
    $annee = $form_paiement_loyer->add('select', 'select_annee');
    $annee->add_options($list_years, true);
    $annee->set_rule(array(
        'required' => array('error', 'Le choix de l\'année est requis!')
    ));
    
    $form_paiement_loyer->add('label','label_loyer', 'loyer', 'Loyer payé');
    $loyer = $form_paiement_loyer->add('text', 'loyer', null, array(
                                    'maxlength' => 8
                                ));
    $loyer->set_rule(array(
        'float' => array(
            ',.',
            'error',
            'Le loyer n\'est pas un nombre!'
        ),
        'regexp' => array(
           '^[0-9]{0,5}(|[,\.]?[0-9]{1,2})$',
           'error',
           "Le loyer est incorrect (format: 12345,67)"
        )
    ));
    
    $form_paiement_loyer->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_paiement_loyer->render();

?>
</div>
<script type="text/javascript">
    choosenVisiteItemListener("select_location");
</script>
<script type="text/javascript" src="./js/paiement.js"></script>