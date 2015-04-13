<h2>Gestion des professionnels</h2>
<div id="formulaire">
<?php
    //formulaire qui permet de gérer les professionnels
    
    $form_professionnel = new Zebra_Form('form_professionnel');
    $form_professionnel->language("francais");
    
    //champ cacher qui contient l'id du professionnel
    $id = $form_professionnel->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    $form_professionnel->add('label','label_nom', 'nom', 'Nom');
    $nom = $form_professionnel->add('text', 'nom', null, array(
                                    'maxlength' => 45
                                ));
    $nom->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_professionnel->add('label','label_prenom', 'prenom', 'Prénom');
    $prenom = $form_professionnel->add('text', 'prenom', null, array(
                                    'maxlength' => 45
                                ));
    
    //il faudra charger les métiers se trouvant dans la table "Metier"
    $metier = $form_professionnel->add('select', 'select_metier');
    $metier->add_options(array(
    
    ));
    
    $form_professionnel->add('label','label_num_tel', 'num_tel', 'Numéro de téléphone');
    $num_tel = $form_professionnel->add('text', 'num_tel', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_professionnel->add('label','label_num_gsm', 'num_gsm', 'Numéro de Gsm');
    $num_gsm = $form_professionnel->add('text', 'num_gsm', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_professionnel->add('label','label_fax', 'num_fax', 'Numéro de fax');
    $num_gsm = $form_professionnel->add('text', 'num_fax', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_professionnel->add('label','label_mail', 'mail', 'Adresse email');
    $mail = $form_professionnel->add('text', 'mail', null, array(
                                    'maxlength' => 20
                                ));
    $mail->set_rule(array(
                'email'    => array('error', 'L\'adresse email est incorrecte!'),
            ));
    
    $form_professionnel->add('label','label_num_tva', 'num_tva', 'Numéro de TVA');
    $tva = $form_professionnel->add('text', 'num_tva', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_professionnel->add('label','label_rue', 'rue', 'Rue');
    $num_gsm = $form_professionnel->add('text', 'rue', null, array(
                                    'maxlength' => 80
                                ));
    $form_professionnel->add('label','label_numero', 'numero', 'N°');
    $num_gsm = $form_professionnel->add('text', 'numero', null, array(
                                    'maxlength' => 10
                                ));
    
    $form_professionnel->add('label','label_boite', 'boite', 'Boîte');
    $num_gsm = $form_professionnel->add('text', 'boite', null, array(
                                    'maxlength' => 10
                                ));
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $form_professionnel->add('label','label_pays', 'select_pays', 'Pays');
    $pays = $form_professionnel->add('select', 'select_pays');
    $pays->add_options(array(
    //ceci ne fonctionne pas (choisissez un pays)    
    ''  => 'Choisissez un pays',
    '1' => 'Belgique',
    '2 '=> 'France',
    '3' => 'Luxembourg',
    'Autre' => 'Autre'
    ));
    
    //ld avec les CP
    $form_professionnel->add('label','label_cp', 'select_cp', 'CP');
    $cp = $form_professionnel->add('select', 'select_cp');
    
    //ld avec les villes
    $form_professionnel->add('label','label_villes', 'select_villes', 'Ville');
    $villes = $form_professionnel->add('select', 'select_villes');
    
    $form_professionnel->add('label','label_remarque', 'remarque', 'Commentaires');
    $num_gsm = $form_professionnel->add('textarea', 'remarque', null, array(
                                    'maxlength' => 10
                                ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_professionnel->add('submit', 'btnsubmit', 'Submit');
    
    $form_professionnel->render('view/templates/tpl_professionnel.php');

?>

</div>