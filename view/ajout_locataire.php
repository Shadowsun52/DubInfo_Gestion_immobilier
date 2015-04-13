<h2>Gestion des locataires</h2>
<div id="formulaire">
<?php
    //formulaire qui permet d'ajouter un locataire
    
    $form_locataire = new Zebra_Form('form_locataire');
    $form_locataire->language("francais");
    
    //champ caché qui contient l'id du locataire
    //Si vide, on insert, autrement on update
    $id = $form_locataire->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    $form_locataire->add('label','label_nom', 'nom', 'Nom');
    $nom = $form_locataire->add('text', 'nom', null, array(
                                    'maxlength' => 45
                                ));
    $nom->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_locataire->add('label','label_prenom', 'prenom', 'Prénom');
    $prenom = $form_locataire->add('text', 'prenom', null, array(
                                    'maxlength' => 45
                                ));
    
    $form_locataire->add('label','label_num_tel', 'num_tel', 'Numéro de téléphone');
    $num_tel = $form_locataire->add('text', 'num_tel', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_locataire->add('label','label_num_gsm', 'num_gsm', 'Numéro de Gsm');
    $num_gsm = $form_locataire->add('text', 'num_gsm', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_locataire->add('label','label_mail', 'mail', 'Adresse email');
    $mail = $form_locataire->add('text', 'mail', null, array(
                                    'maxlength' => 20
                                ));
    $mail->set_rule(array(
                'email'    => array('error', 'L\'adresse email est incorrecte!'),
            ));
    
    //il va falloir ajouter les sources se trouvant dans la table sources_locataires
    $source_locataire = $form_locataire->add('select', 'select_source_locataire');
    
    $form_locataire->add('label','label_budget', 'budget', 'Budget');
    
    $num_gsm = $form_locataire->add('text', 'budget', null, array(
                                    'maxlength' => 20
                                ));
    //date d'enménagement
    $form_locataire->add('label','label_date_rentree', 'date_rentree', 'Date d\'enménagement');
    $num_gsm = $form_locataire->add('text', 'date_rentree', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_locataire->add('label','label_rue', 'rue', 'Rue');
    $num_gsm = $form_locataire->add('text', 'rue', null, array(
                                    'maxlength' => 80
                                ));
    $form_locataire->add('label','label_numero', 'numero', 'N°');
    $num_gsm = $form_locataire->add('text', 'numero', null, array(
                                    'maxlength' => 10
                                ));
    
    $form_locataire->add('label','label_boite', 'boite', 'Boîte');
    $num_gsm = $form_locataire->add('text', 'boite', null, array(
                                    'maxlength' => 10
                                ));
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $form_locataire->add('label','label_pays', 'select_pays', 'Pays');
    $pays = $form_locataire->add('select', 'select_pays');
    $pays->add_options(array(
    //ceci ne fonctionne pas (choisissez un pays)    
    ''  => 'Choisissez un pays',
    '1' => 'Belgique',
    '2 '=> 'France',
    '3' => 'Luxembourg',
    'Autre' => 'Autre'
    ));
    
    //ld avec les CP
    $form_locataire->add('label','label_cp', 'select_cp', 'CP');
    $cp = $form_locataire->add('select', 'select_cp');
    
    //ld avec les villes
    $form_locataire->add('label','label_villes', 'select_villes', 'Ville');
    $villes = $form_locataire->add('select', 'select_villes');
    
    
    $etat = $form_locataire->add('select', 'select_etat');
    $etat->add_options(array(
    //ceci ne fonctionne pas (choisissez un etat)    
    ''  => '- Choisissez un etat -',
    '1' => 'Potentiel',
    '2 '=> 'Actif',
    '3' => 'Abandonné'
    ));
    
    //remarque
    $form_locataire->add('textarea','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_locataire->add('text', 'remarque', null, array(
                                    'maxlength' => 100
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_locataire->add('submit', 'btnsubmit', 'Submit');
    
    $form_locataire->render('view/templates/tpl_investisseur.php');
?>
</div>
