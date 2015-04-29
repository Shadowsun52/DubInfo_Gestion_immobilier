<h2>Gestion des investisseurs</h2>
<div id="formulaire">
    <?php
    use DubInfo_gestion_immobilier\model\Investisseur;
    use DubInfo_gestion_immobilier\model\Adresse;
    use DubInfo_gestion_immobilier\business\InvestisseurCRUD;
    //formulaire qui permet d'ajouter un investisseur
    
    $form_investisseur = new Zebra_Form('form_investisseur');
    $form_investisseur->language("francais");
    
    //création de la liste des investisseurs
    $business = new InvestisseurCRUD();
    $list_invest[''] = '- Nouveau -';
    foreach ($business->readList() as $investisseur) {
        $list_invest[$investisseur->getId()] = $investisseur->toString();
    }
    
    //liste déroulante avec les investisseurs déjà existant
    $form_investisseur->add('label','label_id', 'select_id', 'Liste des investisseurs');
    $id = $form_investisseur->add('select', 'select_id');
    $id->add_options($list_invest ,TRUE);
    
    $form_investisseur->add('label','label_nom', 'nom', 'Nom');
    $nom = $form_investisseur->add('text', 'nom', null, array(
                                    'maxlength' => Investisseur::MAX_SIZE_NOM
                                ));
    $nom->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_investisseur->add('label','label_prenom', 'prenom', 'Prénom');
    $prenom = $form_investisseur->add('text', 'prenom', null, array(
                                    'maxlength' => Investisseur::MAX_SIZE_PRENOM
                                ));

    
    $form_investisseur->add('label','label_num_tel', 'num_tel', 'Numéro de téléphone');
    $num_tel = $form_investisseur->add('text', 'num_tel', null, array(
                                    'maxlength' => Investisseur::MAX_SIZE_NUM
                                ));
    
    $form_investisseur->add('label','label_num_gsm', 'num_gsm', 'Numéro de GSM');
    $num_gsm = $form_investisseur->add('text', 'num_gsm', null, array(
                                    'maxlength' => Investisseur::MAX_SIZE_NUM
                                ));
    
    $form_investisseur->add('label','label_mail', 'mail', 'Adresse email');
    $mail = $form_investisseur->add('text', 'mail', null, array(
                                    'maxlength' => Investisseur::MAX_SIZE_MAIL
                                ));
    $mail->set_rule(array(
                'email'    => array('error', 'L\'adresse email est incorrecte!'),
            ));
    
    $form_investisseur->add('label','label_num_tva', 'num_tva', 'Numéro de TVA');
    $tva = $form_investisseur->add('text', 'num_tva', null, array(
                                    'maxlength' => Investisseur::MAX_SIZE_TVA
                                ));
    
    $form_investisseur->add('label','label_rue', 'rue', 'Rue');
    $rue = $form_investisseur->add('text', 'rue', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_RUE
                                ));
    $form_investisseur->add('label','label_numero', 'numero', 'N°');
    $numero = $form_investisseur->add('text', 'numero', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_NUMERO
                                ));
    
    $form_investisseur->add('label','label_boite', 'boite', 'Boîte');
    $num_boite = $form_investisseur->add('text', 'boite', null, array(
                                    'maxlength' => 10
                                ));
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $form_investisseur->add('label','label_pays', 'select_pays', 'Pays');
    $pays = $form_investisseur->add('select', 'select_pays');
    $pays->add_options(array(
    //ceci ne fonctionne pas (choisissez un pays)    
    ''  => '- Choisissez un pays -',
    'Belgique' => 'Belgique',
    'France'=> 'France',
    'Luxembourg' => 'Luxembourg',
    'Autre' => 'Autre'
    ), true);
    
    //ld avec les CP
    $form_investisseur->add('label','label_cp', 'select_cp', 'Code postal');
    $cp = $form_investisseur->add('select', 'select_cp');
    $cp->add_options(array(
        '' => '- choisissez un code postal -'
    ),true);
            
    //ld avec les villes
    $form_investisseur->add('label','label_villes', 'select_villes', 'Ville');
    $villes = $form_investisseur->add('select', 'select_villes');
    $villes->add_options(array(
        '' => '- choisissez une ville -'
    ),true);
    
    $form_investisseur->add('label', 'label_lettre_mission', 'lettre_mission', 
            'Lettre de mission faite ?');
    $lettre_mission = $form_investisseur->add('radios', 'lettre_mission',
            array(
                '1'    =>  'Oui',
                '0'    =>  'Non'
            ),
            '', // no default value
            array('class' => 'radio_class'));
    
    $form_investisseur->add('label','label_budget', 'budget', 'Budget');
    $budget = $form_investisseur->add('text', 'budget', null, array(
                                    'maxlength' => 11
                                ));
    $budget->set_rule(array(
        'regexp' => array(
           '^[0-9]{0,8}(|[,\.]?[0-9]{1,2})$',
           'error',
           "Le budget est incorrect (format: 12345,67)"
        )
    ));
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $form_investisseur->add('label','label_etat', 'select_etat', 'Etat');
    $etat = $form_investisseur->add('select', 'select_etat');
    $etat->add_options(array(
        '1' => 'Potentiel',
        '2' => 'Actif',
        '9' => 'Propriétaire',
        '3' => 'Abandonné'
    ),true);
    
    //remarque
    $form_investisseur->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_investisseur->add('textarea', 'remarque', null, array(
                                    'maxlength' => Investisseur::MAX_SIZE_COMMENTAIRE
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_investisseur->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_investisseur->render('view/templates/tpl_investisseur.php');    
?>    
</div>    