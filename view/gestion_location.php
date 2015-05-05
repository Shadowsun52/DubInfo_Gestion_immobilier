<h2>Gestion des locations</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\business\LocataireCRUD;
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    //formulaire qui permet de gérer les locations
    
    $form_location = new Zebra_Form('form_location');
    $form_location->language("francais");
    
    $form_location->add('label','label_id', 'select_id', 'Liste des locations');
    $id = $form_location->add('select', 'select_id', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $id->add_options(array('' => '- Nouveau -') ,TRUE);
    
    //choix du locataire
    $business_locataire = new LocataireCRUD();
    $list_locataire[''] = '- Choisissez un locataire -';
    foreach ($business_locataire->readList() as $locataire) {
        $list_locataire[$locataire->getId()] = $locataire->toString();
    }
    $form_location->add('label','label_locataire', 'select_locataire', 'Locataire');
    $locataire = $form_location->add('select', 'select_locataire');
    $locataire->add_options($list_locataire, true);
    $locataire->set_rule(array(
        'required'      =>  array('error', 'Le choix du locataire est requis!')
    ));
    
    //choix de la maison
    $business_maison = new MaisonCRUD();
    $list_maison[''] = '- Choisissez une maison -';
    foreach ($business_maison->readList() as $maison) {
        $list_maison[$maison->getIdProposition()] = $maison->toString();
    }
    $form_location->add('label','label_maison', 'select_maison', 'Maison');
    $maison = $form_location->add('select', 'select_maison');
    $maison->add_options($list_maison, true);
    $maison->set_rule(array(
        'required'      =>  array('error', 'Le choix de la maison est requis!')
    ));
    
    //choix de la chambre
    $form_location->add('label','label_chambres', 'select_chambres', 'Liste des chambres');
    $chambres = $form_location->add('select', 'select_chambres', null, array(
                                            'disabled' => 'disabled'
                                        ));
    $chambres->add_options(array('' => '- Choisissez une chambre -') ,TRUE);
    $chambres->set_rule(array(
        'required'      =>  array('error', 'Le choix du locataire est requis!')
    ));
    
    //choix des dates
    $form_location->add('label','label_date_debut', 'date_debut', 'Date du début');
    $date_debut = $form_location->add('date', 'date_debut');
    $date_debut->set_rule(array(
        'required'      =>  array('error', 'La date est requise!'),
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date_debut->format('d-m-Y');
    
    $form_location->add('label','label_date_fin', 'date_fin', 'Date de fin');
    $date_fin = $form_location->add('date', 'date_fin');
    $date_fin->set_rule(array(
        'required'      =>  array('error', 'La date est requise!'),
        'date'          =>  array('error', 'La date est invalide!'),
    ));
    $date_fin->format('d-m-Y');
    
    $form_location->add('label','label_loyer', 'loyer', 'Loyer');
    $loyer = $form_location->add('text', 'loyer', null, array(
                                    'maxlength' => 8
                                ));
    $loyer->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,5}(|[,\.]?[0-9]{1,2})$',
           'error',
           "Le loyer est incorrect (format: 12345,67)"
        )
    ));
    
    $form_location->add('label','label_charges', 'charges', 'charges');
    $charges = $form_location->add('text', 'charges', null, array(
                                    'maxlength' => 8
                                ));    
    $charges->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,5}(|[,\.]?[0-9]{1,2})$',
           'error',
           "Les charges sont incorrectes (format: 12345,67)"
        )
    ));
    
    $form_location->add('label','label_bail_signe', 'bail_signe', 'Bail signé');
    $bail = $form_location->add('radios', 'bail_signe',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    $form_location->add('label','label_etat_lieux_signe', 'etat_lieux_signe', 
            'Etat des lieux signé');
    $etat_lieux = $form_location->add('radios', 'etat_lieux_signe',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    $form_location->add('label','label_charte_signee', 'charte_signee', 'Charte signée');
    $charte = $form_location->add('radios', 'charte_signee',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    //garantie
    $form_location->add('label','label_garantie_total', 'garantie_total', 
            'Garantie locative à payer');
    $garantie_total = $form_location->add('text', 'garantie_total', null, array(
                                    'maxlength' => 11
                                ));
    $garantie_total->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,8}(|[,\.]?[0-9]{1,2})$',
           'error',
           "La garantie locative est incorrecte (format: 12345,67)"
        )
    ));
    
    $form_location->add('label','label_garantie_payee', 'garantie_payee', 
            'Garantie locative payée');
    $garantie_payee = $form_location->add('text', 'garantie_payee', null, array(
                                    'maxlength' => 11
                                ));
    $garantie_payee->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,8}(|[,\.]?[0-9]{1,2})$',
           'error',
           "La garantie locative est incorrecte (format: 12345,67)"
        )
    ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_location->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_location->render('view/templates/tpl_location.php');

?>

</div>
<script type="text/javascript">
    choosenVisiteItemListener("select_locataire");
</script>