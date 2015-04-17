<h2>Gestion des locataires</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\Locataire;
    use DubInfo_gestion_immobilier\model\Adresse;
//    use DubInfo_gestion_immobilier\business\InvestisseurCRUD;
    //formulaire qui permet de gérer les locataires
    
    //création de la liste des investisseurs
//    $business = new InvestisseurCRUD();
    $list_locataire[''] = '- Nouveau -';
//    foreach ($business->readList() as $locataire) {
//        $list_locataire[$locataire->getId()] = $locataire->toString();
//    }
    
    $form_locataire = new Zebra_Form('form_locataire');
    $form_locataire->language("francais");
    
    //liste déroulante avec les locataires déjà existant
    $form_locataire->add('label','label_id', 'select_id', 'Liste des locataires');
    $id = $form_locataire->add('select', 'select_id');
    $id->add_options($list_locataire ,TRUE);
    
    $form_locataire->add('label','label_nom', 'nom', 'Nom');
    $nom = $form_locataire->add('text', 'nom', null, array(
                                    'maxlength' => Locataire::MAX_SIZE_NOM
                                ));
    $nom->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_locataire->add('label','label_prenom', 'prenom', 'Prénom');
    $prenom = $form_locataire->add('text', 'prenom', null, array(
                                    'maxlength' => Locataire::MAX_SIZE_PRENOM
                                ));
    
    $form_locataire->add('label','label_num_tel', 'num_tel', 'Numéro de téléphone');
    $num_tel = $form_locataire->add('text', 'num_tel', null, array(
                                    'maxlength' => Locataire::MAX_SIZE_NUM
                                ));
    
    $form_locataire->add('label','label_num_gsm', 'num_gsm', 'Numéro de Gsm');
    $num_gsm = $form_locataire->add('text', 'num_gsm', null, array(
                                    'maxlength' => Locataire::MAX_SIZE_NUM
                                ));
    
    $form_locataire->add('label','label_mail', 'mail', 'Adresse email');
    $mail = $form_locataire->add('text', 'mail', null, array(
                                    'maxlength' => Locataire::MAX_SIZE_MAIL
                                ));
    $mail->set_rule(array(
                'email'    => array('error', 'L\'adresse email est incorrecte!'),
            ));
    
    //il va falloir ajouter les sources se trouvant dans la table sources_locataires
    $form_locataire->add('label', 'label_source', 'select_source', 'Source');
    $source_locataire = $form_locataire->add('select', 'select_source');
    $source_locataire->add_options(array(
        //ceci ne fonctionne pas (choisissez un pays)    
        ''  => '- Choisissez une source -',
        //TODO generer liste sources
        'Autre' => 'Autres'
    ), true);
    
    $form_locataire->add('label','label_budget', 'budget', 'Budget');
    $budget = $form_locataire->add('text', 'budget', null, array(
                                    'maxlength' => 10
                                ));
    $budget->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,5}(|[,\.]?[0-9]{1,2})$',
           'error',
           "Le budget est incorrect (format: 12345,67)"
        )
    ));
    
    //date d'enménagement
    $form_locataire->add('label','label_date_rentree', 'date_rentree', 'Date d\'enménagement');
    $date_rentree = $form_locataire->add('date', 'date_rentree');
    $date_rentree->set_rule(array(
        'date'          =>  array('error', 'Date invalide!'),
    ));
    $date_rentree->format('d M, Y');
    
    $form_locataire->add('label','label_rue', 'rue', 'Rue');
    $rue = $form_locataire->add('text', 'rue', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_RUE
                                ));
    $form_locataire->add('label','label_numero', 'numero', 'N°');
    $numero = $form_locataire->add('text', 'numero', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_NUMERO
                                ));
    
    $form_locataire->add('label','label_boite', 'boite', 'Boîte');
    $boite = $form_locataire->add('text', 'boite', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_BOITE
                                ));
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $form_locataire->add('label','label_pays', 'select_pays', 'Pays');
    $pays = $form_locataire->add('select', 'select_pays');
    $pays->add_options(array(
        //ceci ne fonctionne pas (choisissez un pays)    
        ''  => '- Choisissez un pays -',
        'Belgique' => 'Belgique',
        'France'=> 'France',
        'Luxembourg' => 'Luxembourg',
        'Autre' => 'Autre'
    ), true);
    
    //ld avec les CP
    $form_locataire->add('label','label_cp', 'select_cp', 'Code postal');
    $cp = $form_locataire->add('select', 'select_cp');
    $cp->add_options(array(
        '' => '- choisissez un code postal -'
    ),true);
            
    //ld avec les villes
    $form_locataire->add('label','label_villes', 'select_villes', 'Ville');
    $villes = $form_locataire->add('select', 'select_villes');
    $villes->add_options(array(
        '' => '- choisissez une ville -'
    ),true);
    
    $etat = $form_locataire->add('select', 'select_etat');
    $etat->add_options(array( 
    ''  => '- Choisissez un etat -',
    '1' => 'Potentiel',
    '2' => 'Actif',
    '4' => 'Locataire',
    '3' => 'Abandonné'
    ));
    
    //communes préférées
    $form_locataire->add('label','label_communes', 'select_communes',
            'Communes préferées');
    $communes = $form_locataire->add('select', 'select_communes', null, array(
                                    'name' => 'select_communes[]',
                                    'multiple' => 'multiple',
                                    'size' => 5
                                ));
    $communes->add_options(array(
        '1' =>'test',
        '2' => 'test2'//TODO genere liste Commune bruxelles 
   ),true);
    
    //remarque
    $form_locataire->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_locataire->add('textarea', 'remarque', null, array(
                                    'maxlength' => Locataire::MAX_SIZE_COMMENTAIRE
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_locataire->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_locataire->render('view/templates/tpl_locataire.php');
?>
</div>
