<h2>Gestion des maisons</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\Maison;
    use DubInfo_gestion_immobilier\model\Adresse;
    use DubInfo_gestion_immobilier\model\SourceMaison;
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    use DubInfo_gestion_immobilier\business\SourceMaisonCRUD;
    use DubInfo_gestion_immobilier\business\ContactCRUD;
    use DubInfo_gestion_immobilier\business\CommuneCRUD;
    
    define('MAX_NB_CHAMBRES', 20);
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
    
    $form_maison->add('label','label_reference', 'reference', 'Référence');
    $reference = $form_maison->add('text', 'reference', null, array(
                                    'maxlength' => Maison::MAX_SIZE_REFERENCE
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
    
    //communes
    $business_adresse = new CommuneCRUD();
    $list_communes[''] = '- Choisissez une commune -';
    foreach ($business_adresse->readList() as $commune) {
        $list_communes[$commune->getId()] = $commune->toString();
    }
    
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
    
    $form_maison->add('label','label_reference_source', 'reference_source', 
            'Référence source');
    $reference_source = $form_maison->add('text', 'reference_source', null, array(
                                    'maxlength' => SourceMaison::MAX_SIZE_REFERENCE
                                ));
    
    $business_contact = new ContactCRUD();
    $list_contact[''] = '- Choisissez un contact -';
    foreach ($business_contact->readList() as $contact) {
        $list_contact[$contact->getId()] = $contact->toString();
    }
    $list_contact['@Autre@'] = '- Ajouter un contact -';
    
    $form_maison->add('label', 'label_contact', 'select_contact1', 'Contact');
    $contact = $form_maison->add('select', 'select_contact1');
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
    
    //label et text du prix conseillé
    $form_maison->add('label','label_prix_conseille', 'prix_conseille', 
            'Prix conseillé');
    $prix_conseille = $form_maison->add('text', 'prix_conseille', null, array(
                                    'maxlength' => 13
                                ));
    $prix_conseille->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,10}(|[,\.]?[0-9]{1,2})$',
           'error',
           "Le prix conseillé est incorrect (format: 12345,67)"
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
    
    $form_maison->add('label','label_prix_mcarre', 'prix_mcarre', 'Prix/m²');
    $prixmcarre = $form_maison->add('text', 'prix_mcarre', null, array(
                                    'readonly' => 'true'
                                ));
    
    //nombre de chambres
    $nb_chambres[0] = '- Combien de chambres ? -';
    for ($i=1; $i <= MAX_NB_CHAMBRES; $i++) {
        $nb_chambres[$i] = $i;
    }
    $form_maison->add("label","label_chambres","select_chambres","Nombre de chambres");
    $chambres = $form_maison->add('select', 'select_chambres');
    $chambres->add_options($nb_chambres, true);
    
    //salle de bain (sdb)
    $form_maison->add("label","label_sdb","select_sdb","Nombre de salle de bain");
    $sdb = $form_maison->add('select', 'select_sdb');
    $sdb->add_options(array( 
    ''  => '- Combien de salle de bain ? -',
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4',
    '5' => '5'
    ), true);
    
    $form_maison->add('label','label_rendement', 'rendement', 'Rendement');
    $rendement = $form_maison->add('text', 'rendement', null, array(
                                    'maxlength' => 4
                                ));
    $rendement->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,2}(|[,\.]?[0-9]?)$',
           'error',
           "Le rendement sont incorrect (format: 12,3)"
        )
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
    
    $form_maison->add('label', 'label_dossier', 'dossier', 
            'Dossier réalisé ?');
    $dossier = $form_maison->add('radios', 'dossier',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    $form_maison->add('label','label_localisation', 'localisation', 'Localisation');
    $localisation = $form_maison->add('text', 'localisation', null, array(
                                    'maxlength' => Maison::MAX_SIZE_LOCALISATION
                                ));
    
    $form_maison->add("label","label_localisation_indice",
            "select_localisation_indice","Indice");
    $localisation_indice = $form_maison->add('select', 'select_localisation_indice');
    $localisation_indice->add_options(array( 
    ''  => '- Choissisez l\'indice ? -',
    '1' => '1',
    '2' => '2',
    '3' => '3',
    ), true);
    
    $form_maison->add('label','label_qualite', 'qualite', 'Qualité du bien');
    $qualite = $form_maison->add('text', 'qualite', null, array(
                                    'maxlength' => Maison::MAX_SIZE_QUALITE
                                ));
    
    $form_maison->add("label","label_qualite_indice", "select_qualite_indice","Indice");
    $qualite_indice = $form_maison->add('select', 'select_qualite_indice');
    $qualite_indice->add_options(array( 
    ''  => '- Choissisez l\'indice ? -',
    '1' => '1',
    '2' => '2',
    '3' => '3',
    ), true);
    
    $form_maison->add('label','label_etat','select_etat','Etat');
    $etat = $form_maison->add('select', 'select_etat');
    $etat->add_options(array(
        '1' => 'Potentiel',
        '5' => 'Retenu',
        '6' => 'A suivre',
        '10' => 'Projet',
        '7' => 'Location',
        '3' => 'Abandonné'
    ),true);
    
    $form_maison->add('label', 'label_show', 'show', 
            'Afficher la maison sur le site ?');
    $show = $form_maison->add('radios', 'show',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    //label et text de la remarque
    $form_maison->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_maison->add('textarea', 'remarque', null, array(
                                    'maxlength' => Maison::MAX_SIZE_COMMENTAIRE
                                ));
    
    $form_maison->add('label','label_raison_abandon','raison_abandon','Raison de l\'abandon');
    $abandon = $form_maison->add('textarea', 'raison_abandon', null, array(
                                    'maxlength' => Maison::MAX_SIZE_RAISON_ABANDON
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_maison->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_maison->render('view/templates/tpl_maisons.php');
?>
    </div>
<script src="js/contact.js"></script>
<script type="text/javascript">
    addChangeEtatListener();
</script>