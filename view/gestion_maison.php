<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\Maison;
    use DubInfo_gestion_immobilier\model\Adresse;
    use DubInfo_gestion_immobilier\model\SourceMaison;
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    use DubInfo_gestion_immobilier\business\AdresseCRUD;
    use DubInfo_gestion_immobilier\business\SourceMaisonCRUD;
    use DubInfo_gestion_immobilier\business\ContactCRUD;
    
    //formulaire qui permet de gérer les maisons
    
    $form_maison = new Zebra_Form('form_maison');
    $form_maison->language("francais");
    
    //création de la liste des locataire
    $business = new MaisonCRUD();
    $list_maisons[''] = '- Nouveau -';
    foreach ($business->readList() as $maison) {
        $list_maisons[$maison->getIdProposition()] = $maison->toString();
    }
    
    //liste déroulante avec les maisons déjà existante
    $form_maison->add('label','label_id', 'select_id', 'Liste des Maisons');
    $id = $form_maison->add('select', 'select_id');
    $id->add_options($list_maisons ,TRUE);
    
    $form_maison->add('label','label_titre', 'titre', 'Titre');
    $titre = $form_maison->add('text', 'titre', null, array(
                                    'maxlength' => Maison::MAX_SIZE_TITRE
                                ));
    $titre->set_rule(array(
               'required' => array('error', 'Titre requis!'), 
            ));
    
    $form_maison->add('label','label_rue', 'rue', 'Rue');
    $rue = $form_maison->add('text', 'rue', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_RUE
                                ));
    $form_maison->add('label','label_numero', 'numero', 'N°');
    $numero = $form_maison->add('text', 'numero', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_NUMERO
                                ));
    
    //communes préférées
    $business_adresse = new AdresseCRUD();
    $list_communes[''] = '- Choisissez une commune -';
    $list_communes = array_merge($list_communes, 
            $business_adresse->readCommunesBruxelles());
    $form_maison->add('label','label_commune', 'select_commune', 'Communes');
    $communes = $form_maison->add('select', 'select_commune');
    $communes->add_options($list_communes, true);
    
    $business_source = new SourceMaisonCRUD();
    $list_sources[''] = '- Choisissez une source -';
    foreach ($business_source->readList() as $source) {
        $list_sources[$source->getId()] = $source->toString();
    }
    
    //label de la source
    $form_maison->add('label','label_source', 'select_source', 'Source');
    //select de la source
    $source = $form_maison->add('select', 'select_source');
    $source->add_options($list_sources, true);
    
    $form_maison->add('label','label_reference', 'reference', 'Référence');
    $reference = $form_maison->add('text', 'reference', null, array(
                                    'maxlength' => SourceMaison::MAX_SIZE_REFERENCE
                                ));
    
    $business_contact = new ContactCRUD();
    $list_contact[''] = '- Choisissez un contact -';
    foreach ($business_contact->readList() as $contact) {
        $list_contact[$contact->getId()] = $contact->toString();
    }
    
    $form_maison->add('label', 'label_contact', 'select_contact', 'Contact');
    $contact = $form_maison->add('select', 'select_contact');
    $contact->add_options($list_contact, true);
    
    //label et text du prix
    $form_maison->add('label','label_prix', 'prix', 'Prix');
    $prix = $form_maison->add('text', 'prix', null, array(
                                    'maxlength' => 13
                                ));
    $prix->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,10}(|[,\.]?[0-9]{1,2})$',
           'error',
           "Le prix est incorrect (format: 12345,67)"
        )
    ));
    
    //label et text de la superficie
    $form_maison->add('label','label_superficie_habitable', 'superficie_habitable', 'Superficie habitable en m²');
    $superficie = $form_maison->add('text', 'superficie_habitable', null, array(
                                    'maxlength' => 20
                                ));
    $superficie->set_rule(array(
        'number' => array(
           '',
           'error',
           "La superficie n'est pas un nombre!"
        )
    ));
    
    //salle de bain (sdb)
    $form_maison->add("label","label_sdb","select_sdb","Nombre de salle de bain");
    $sdb = $form_maison->add('select', 'select_sdb');
    $sdb->add_options(array(
    //ceci ne fonctionne pas (choisissez un etat)    
    ''  => '- Combien de salle de bain ? -',
    '1' => '1',
    '2 '=> '2',
    '3' => '3',
    '4' => '4',
    '5' => '5'
    ));
    
    ////label et text des coûts des travaux
    $form_maison->add('label','label_cout_travaux', 'cout_travaux', 'Coût travaux');
    $cout_travaux = $form_maison->add('text', 'cout_travaux', null, array(
                                    'maxlength' => 13
                                ));
    $cout_travaux->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,10}(|[,\.]?[0-9]{1,2})$',
           'error',
           "Les coût travaux sont incorrect (format: 12345,67)"
        )
    ));
    
    $form_maison->add('label','label_etat','select_etat','Etat');
    $etat = $form_maison->add('select', 'select_etat');
    $etat->add_options(array(
        '1' => 'Potentiel',
        '5' => 'Retenu',
        '6' => 'A suivre',
        '7' => 'Prêt à louer',
        '3' => 'Abandonné'
    ),true);
    
    //label et text de la remarque
    $form_maison->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_maison->add('textarea', 'remarque', null, array(
                                    'maxlength' => Maison::MAX_SIZE_COMMENTAIRE
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_maison->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_maison->render('view/templates/tpl_maisons.php');

