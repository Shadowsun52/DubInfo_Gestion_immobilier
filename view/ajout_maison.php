<?php
    //formulaire qui permet de gérer les maisons
    
    $form_maison = new Zebra_Form('form_maison');
    $form_maison->language("francais");
    
    //champ cacher qui contient l'id de l'investisseur
    $id = $form_maison->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    $form_maison->add('label','label_nom', 'nom', 'Nom');
    $nom = $form_maison->add('text', 'nom', null, array(
                                    'maxlength' => 45
                                ));
    $nom->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_maison->add('label','label_prenom', 'prenom', 'Prénom');
    $prenom = $form_maison->add('text', 'prenom', null, array(
                                    'maxlength' => 45
                                ));
    
    $form_maison->add('label','label_num_tel', 'num_tel', 'Numéro de téléphone');
    $num_tel = $form_maison->add('text', 'num_tel', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_maison->add('label','label_num_gsm', 'num_gsm', 'Numéro de Gsm');
    $num_gsm = $form_maison->add('text', 'num_gsm', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_maison->add('label','label_mail', 'mail', 'Adresse email');
    $mail = $form_maison->add('text', 'mail', null, array(
                                    'maxlength' => 20
                                ));
    $mail->set_rule(array(
                'email'    => array('error', 'L\'adresse email est incorrecte!'),
            ));
    
    $form_maison->add('label','label_num_tva', 'num_tva', 'Numéro de TVA');
    $num_gsm = $form_maison->add('text', 'num_tva', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_maison->add('label','label_rue', 'rue', 'Rue');
    $num_gsm = $form_maison->add('text', 'rue', null, array(
                                    'maxlength' => 80
                                ));
    $form_maison->add('label','label_numero', 'numero', 'N°');
    $num_gsm = $form_maison->add('text', 'numero', null, array(
                                    'maxlength' => 10
                                ));
    
    $form_maison->add('label','label_boite', 'boite', 'Boîte');
    $num_gsm = $form_maison->add('text', 'boite', null, array(
                                    'maxlength' => 10
                                ));
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $pays = $form_maison->add('select', 'select_pays');
    $pays->add_options(array(
    //ceci ne fonctionne pas (choisissez un pays)    
    ''  => 'Choisissez un pays',
    '1' => 'Belgique',
    '2 '=> 'France',
    '3' => 'Luxembourg',
    'Autre' => 'Autre'
    ));
    
    //ld avec les CP
    $cp = $form_maison->add('select', 'select_cp');
    
    //ld avec les villes
    $villes = $form_maison->add('select', 'select_villes');
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $etat = $form_maison->add('select', 'select_etat');
    $etat->add_options(array(
    //ceci ne fonctionne pas (choisissez un etat)    
    ''  => '- Choisissez un etat -',
    '1' => 'Potentiel',
    '2 '=> 'Actif',
    '3' => 'Abandonné'
    ));
    
    //remarque
    $form_maison->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_maison->add('text', 'remarque', null, array(
                                    'maxlength' => 100
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_maison->add('submit', 'btnsubmit', 'Submit');
    
    $form_maison->render();

