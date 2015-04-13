<h2>Gestion des investisseurs</h2>
<div id="formulaire">
    <?php
    //formulaire qui permet d'ajouter un investisseur
    
    $form_investisseur = new Zebra_Form('form_investisseur');
    $form_investisseur->language("francais");
    
    //champ cacher qui contient l'id de l'investisseur
    $id = $form_investisseur->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    $form_investisseur->add('label','label_nom', 'nom', 'Nom');
    $nom = $form_investisseur->add('text', 'nom', null, array(
                                    'maxlength' => 45
                                ));
    $nom->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_investisseur->add('label','label_prenom', 'prenom', 'Prénom');
    $prenom = $form_investisseur->add('text', 'prenom', null, array(
                                    'maxlength' => 45
                                ));

    
    $form_investisseur->add('label','label_num_tel', 'num_tel', 'Numéro de téléphone');
    $num_tel = $form_investisseur->add('text', 'num_tel', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_investisseur->add('label','label_num_gsm', 'num_gsm', 'Numéro de GSM');
    $num_gsm = $form_investisseur->add('text', 'num_gsm', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_investisseur->add('label','label_mail', 'mail', 'Adresse email');
    $mail = $form_investisseur->add('text', 'mail', null, array(
                                    'maxlength' => 20
                                ));
    $mail->set_rule(array(
                'email'    => array('error', 'L\'adresse email est incorrecte!'),
            ));
    
    $form_investisseur->add('label','label_num_tva', 'num_tva', 'Numéro de TVA');
    $tva = $form_investisseur->add('text', 'num_tva', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_investisseur->add('label','label_rue', 'rue', 'Rue');
    $rue = $form_investisseur->add('text', 'rue', null, array(
                                    'maxlength' => 70
                                ));
    $form_investisseur->add('label','label_numero', 'numero', 'N°');
    $numero = $form_investisseur->add('text', 'numero', null, array(
                                    'maxlength' => 10
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
    '1' => 'Belgique',
    '2 '=> 'France',
    '3' => 'Luxembourg',
    'Autre' => 'Autre'
    ), true);
    
    //ld avec les CP
    $form_investisseur->add('label','label_cp', 'select_cp', 'Code postal');
    $cp = $form_investisseur->add('select', 'select_cp');
    
    //ld avec les villes
    $form_investisseur->add('label','label_villes', 'select_villes', 'Ville');
    $villes = $form_investisseur->add('select', 'select_villes');
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $form_investisseur->add('label','label_etat', 'select_etat', 'Etat');
    $etat = $form_investisseur->add('select', 'select_etat');
    $etat->add_options(array(
        '1' => 'Potentiel',
        '2 '=> 'Actif',
        '3' => 'Abandonné'
    ));
    
    //remarque
    $form_investisseur->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_investisseur->add('textarea', 'remarque', null, array(
                                    'maxlength' => 500
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_investisseur->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_investisseur->render('view/templates/tpl_investisseur.php');    
?>    
</div>    